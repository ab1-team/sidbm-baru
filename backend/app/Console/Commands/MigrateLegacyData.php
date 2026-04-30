<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\Tenant;

class MigrateLegacyData extends Command
{
    protected $signature = 'migrate:legacy {--location= : Specific location ID to migrate}';
    protected $description = 'Migrate data from legacy SIDBM database to new multi-tenant structure';

    public function handle()
    {
        $locationId = $this->option('location');

        try {
            DB::connection('legacy')->getPdo();
        } catch (\Exception $e) {
            $this->error("Could not connect to legacy database: " . $e->getMessage());
            return;
        }

        $query = DB::connection('legacy')->table('kecamatan');
        if ($locationId) {
            $query->where('id', $locationId);
        }

        $locations = $query->get();

        if ($locations->isEmpty()) {
            $this->error('No locations found in legacy database.');
            return;
        }

        foreach ($locations as $location) {
            $this->migrateLocation($location);
        }

        $this->info('All migrations completed successfully!');
    }

    protected function migrateLocation($location)
    {
        $name = $location->nama_kec ?? $location->kecamatan ?? "Location {$location->id}";
        $this->info("========================================");
        $this->info("Migrating location: {$name} (ID: {$location->id})");
        $this->info("========================================");

        // 1. Create or Find Tenant
        $tenantId = 'tenant_' . $location->id;
        $tenant = Tenant::find($tenantId);

        if (!$tenant) {
            $this->line("Creating tenant for {$name}...");
            $tenant = Tenant::create([
                'id' => $tenantId,
                'name' => $name,
                'location_id' => $location->id,
            ]);
            // Use location ID as subdomain
            $tenant->domains()->create(['domain' => $location->id . '.sidbm.test']);

            // Run migrations for this tenant
            $this->line("Running migrations for {$tenantId}...");
            \Illuminate\Support\Facades\Artisan::call('tenants:migrate', [
                '--tenants' => [$tenantId],
            ]);
        }

        // 2. Initialize Tenant Context
        tenancy()->initialize($tenant);

        // 3. Migrate Central Data
        $this->migrateCentralData($location);

        // 4. Migrate Tenant-specific Tables
        $suffix = '_' . $location->id;
        $this->migrateTenantTables($suffix);

        // 5. End Tenant Context
        tenancy()->end();
    }

    protected function migrateCentralData($location)
    {
        DB::connection('mysql')->table('kecamatan')->updateOrInsert(
            ['id' => $location->id],
            [
                'nama_kec' => $location->nama_kec ?? $location->kecamatan ?? "Location {$location->id}",
                'kd_kec' => $location->kd_kec ?? '0',
                'kd_kab' => $location->kd_kab ?? '0',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );
    }

    protected function migrateTenantTables($suffix)
    {
        $tableMapping = [
            'anggota' => 'anggota',
            'kelompok' => 'kelompok',
            'pinjaman_kelompok' => 'pinjaman_kelompok',
            'pinjaman_anggota' => 'pinjaman_anggota',
            'transaksi' => 'transaksi',
            'saldo' => 'balances',
            'rekening' => 'rekenings',
            'real_angsuran' => 'real_angsuran',
            'rencana_angsuran' => 'rencana_angsuran',
            'inventaris' => 'inventaris',
            'ebudgeting' => 'ebudgeting',
            'arus_kas' => 'arus_kas',
            'arus_kas_rekening' => 'arus_kas_rekenings',
        ];

        foreach ($tableMapping as $legacyBase => $newTable) {
            $legacyTable = $legacyBase . $suffix;
            
            // Handle cases where table names might be different
            if (!Schema::connection('legacy')->hasTable($legacyTable)) {
                if ($legacyBase === 'rekening' && Schema::connection('legacy')->hasTable('rekening' . $suffix)) {
                    $legacyTable = 'rekening' . $suffix;
                } else if ($legacyBase === 'saldo' && Schema::connection('legacy')->hasTable('saldo' . $suffix)) {
                    $legacyTable = 'saldo' . $suffix;
                } else {
                    continue;
                }
            }

            $this->line("  Migrating: {$legacyTable} -> {$newTable}");
            
            if ($newTable === 'balances') {
                $this->migrateBalances($legacyTable);
            } else {
                $this->migrateTable($legacyTable, $newTable);
            }
        }
    }

    protected function migrateTable($legacyTable, $newTable)
    {
        $data = DB::connection('legacy')->table($legacyTable)->get();
        if ($data->isEmpty()) return;

        Schema::disableForeignKeyConstraints();
        DB::table($newTable)->truncate();

        $transformed = $data->map(function ($item) use ($newTable) {
            $arr = (array) $item;
            return $this->transform($newTable, $arr);
        })->toArray();

        collect($transformed)->chunk(200)->each(function ($chunk) use ($newTable) {
            DB::table($newTable)->insert($chunk->toArray());
        });
        Schema::enableForeignKeyConstraints();
    }

    protected function migrateBalances($legacyTable)
    {
        $data = DB::connection('legacy')->table($legacyTable)->get();
        if ($data->isEmpty()) return;

        Schema::disableForeignKeyConstraints();
        DB::table('balances')->truncate();

        $grouped = $data->groupBy(function($item) {
            return $item->kode_akun . '_' . $item->tahun;
        });

        $finalBalances = [];
        $now = now()->toDateTimeString();
        foreach ($grouped as $key => $items) {
            $first = $items->first();
            $row = [
                'id' => abs(crc32($first->kode_akun . $first->tahun)),
                'kode_akun' => $first->kode_akun,
                'tahun' => $first->tahun,
                'created_at' => $now,
                'updated_at' => $now,
            ];

            for ($i = 1; $i <= 12; $i++) {
                $m = str_pad($i, 2, '0', STR_PAD_LEFT);
                $row["debit_{$m}"] = 0;
                $row["kredit_{$m}"] = 0;
            }

            foreach ($items as $item) {
                if ($item->bulan < 1 || $item->bulan > 12) continue;
                $m = str_pad($item->bulan, 2, '0', STR_PAD_LEFT);
                $row["debit_{$m}"] = $this->num($item->debit);
                $row["kredit_{$m}"] = $this->num($item->kredit);
            }

            $finalBalances[] = $row;
        }

        collect($finalBalances)->chunk(200)->each(function ($chunk) {
            DB::table('balances')->insert($chunk->toArray());
        });
        Schema::enableForeignKeyConstraints();
    }

    protected function num($val)
    {
        return is_numeric($val) ? $val : 0;
    }

    protected function transform($table, $data)
    {
        $now = now()->toDateTimeString();
        switch ($table) {
            case 'anggota':
                return [
                    'id' => $data['id'],
                    'nik' => $data['nik'] ?? '0',
                    'nama_lengkap' => $data['namadepan'] ?? '',
                    'jenis_kelamin' => ($data['jk'] ?? 'L') == 'P' ? 'P' : 'L',
                    'tempat_lahir' => $data['tempat_lahir'] ?? null,
                    'tgl_lahir' => $data['tgl_lahir'] ?? null,
                    'alamat' => $data['alamat'] ?? null,
                    'desa' => $data['desa'] ?? null,
                    'hp' => $data['hp'] ?? null,
                    'kk' => $data['kk'] ?? null,
                    'nik_penjamin' => $data['nik_penjamin'] ?? null,
                    'nama_penjamin' => $data['penjamin'] ?? null,
                    'hubungan_penjamin' => $data['hubungan'] ?? null,
                    'usaha' => $data['usaha'] ?? null,
                    'tgl_gabung' => $data['terdaftar'] ?? null,
                    'status' => (int)($data['status'] ?? 1),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'kelompok':
                return [
                    'id' => $data['id'],
                    'kd_kelompok' => $data['kd_kelompok'],
                    'nama_kelompok' => $data['nama_kelompok'],
                    'desa' => $data['desa'],
                    'alamat_kelompok' => $data['alamat_kelompok'] ?? null,
                    'telpon' => $data['telpon'] ?? null,
                    'tgl_berdiri' => $data['tgl_berdiri'] ?? null,
                    'ketua' => $data['ketua'],
                    'sekretaris' => $data['sekretaris'],
                    'bendahara' => $data['bendahara'],
                    'status' => (int)($data['status'] ?? 1),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'pinjaman_kelompok':
                return [
                    'id' => $data['id'],
                    'kelompok_id' => $data['id_kel'],
                    'pinjaman_ke' => $this->num($data['pinjaman_ke'] ?? 1),
                    'jpp_id' => $this->num($data['jenis_pp'] ?? 1),
                    'tgl_proposal' => $data['tgl_proposal'],
                    'tgl_verifikasi' => $data['tgl_verifikasi'],
                    'tgl_dana' => $data['tgl_dana'],
                    'tgl_cair' => $data['tgl_cair'],
                    'tgl_lunas' => $data['tgl_lunas'],
                    'proposal' => $this->num($data['proposal'] ?? 0),
                    'verifikasi' => $this->num($data['verifikasi'] ?? 0),
                    'alokasi' => $this->num($data['alokasi'] ?? 0),
                    'pros_jasa' => $this->num($data['pros_jasa'] ?? 0),
                    'jangka' => $this->num($data['jangka'] ?? 0),
                    'sistem_angsuran' => $this->num($data['sistem_angsuran'] ?? 1),
                    'spk_no' => $data['spk_no'] ?? null,
                    'status' => $data['status'] ?? 'P',
                    'catatan_verifikasi' => $data['catatan_verifikasi'] ?? null,
                    'catatan_bimbingan' => $data['catatan_bimbingan'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'pinjaman_anggota':
                return [
                    'id' => $data['id'],
                    'anggota_id' => $data['id_kel'], 
                    'pinjaman_kelompok_id' => $data['id_pinkel'],
                    'jpp_id' => $this->num($data['jenis_pp'] ?? 1),
                    'nia' => $data['nia'] ?? null,
                    'tgl_proposal' => $data['tgl_proposal'] ?? null,
                    'tgl_verifikasi' => $data['tgl_verifikasi'] ?? null,
                    'tgl_dana' => $data['tgl_dana'] ?? null,
                    'tgl_cair' => $data['tgl_cair'],
                    'tgl_lunas' => $data['tgl_lunas'] ?? null,
                    'proposal' => $this->num($data['proposal'] ?? 0),
                    'verifikasi' => $this->num($data['verifikasi'] ?? 0),
                    'alokasi' => $this->num($data['alokasi'] ?? 0),
                    'pros_jasa' => $this->num($data['pros_jasa'] ?? 0),
                    'jangka' => $this->num($data['jangka'] ?? 0),
                    'sistem_angsuran' => $this->num($data['sistem_angsuran'] ?? 1),
                    'status' => $data['status'] ?? 'P',
                    'catatan_verifikasi' => $data['catatan_verifikasi'] ?? null,
                    'catatan_bimbingan' => $data['catatan_bimbingan'] ?? null,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'transaksi':
                return [
                    'idt' => $data['idt'],
                    'tgl_transaksi' => $data['tgl_transaksi'],
                    'rekening_debit' => $data['rekening_debit'],
                    'rekening_kredit' => $data['rekening_kredit'],
                    'idtp' => $data['idtp'],
                    'id_pinj' => $data['id_pinj'],
                    'keterangan_transaksi' => $data['keterangan_transaksi'],
                    'jumlah' => $this->num($data['jumlah']),
                    'id_user' => $data['id_user'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'rekenings':
                return [
                    'kode_akun' => $data['kode_akun'],
                    'nama_akun' => $data['nama_akun'],
                    'parent_id' => $data['parent_id'] ?? 0,
                    'lev1' => $data['lev1'],
                    'lev2' => $data['lev2'],
                    'lev3' => $data['lev3'],
                    'lev4' => $data['lev4'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'real_angsuran':
                return [
                    'pinjaman_kelompok_id' => $data['loan_id'],
                    'tgl_transaksi' => $data['tgl_transaksi'],
                    'realisasi_pokok' => $this->num($data['realisasi_pokok']),
                    'realisasi_jasa' => $this->num($data['realisasi_jasa']),
                    'saldo_pokok' => $this->num($data['saldo_pokok']),
                    'saldo_jasa' => $this->num($data['saldo_jasa']),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'rencana_angsuran':
                return [
                    'pinjaman_kelompok_id' => $data['loan_id'],
                    'angsuran_ke' => $this->num($data['angsuran_ke']),
                    'jatuh_tempo' => $data['jatuh_tempo'],
                    'wajib_pokok' => $this->num($data['wajib_pokok']),
                    'wajib_jasa' => $this->num($data['wajib_jasa']),
                    'target_pokok' => $this->num($data['target_pokok']),
                    'target_jasa' => $this->num($data['target_jasa']),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            case 'inventaris':
                return [
                    'id' => $data['id'],
                    'nama_barang' => $data['nama_barang'],
                    'tgl_beli' => $data['tgl_beli'],
                    'unit' => $this->num($data['unit']),
                    'harga_satuan' => $this->num($data['harsat']),
                    'umur_ekonomis' => $this->num($data['umur_ekonomis']),
                    'status' => $data['status'],
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

            default:
                return $data;
        }
    }
}
