<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinjamanAnggota extends Model
{
    use SoftDeletes;

    protected $table = 'pinjaman_anggota';

    protected $fillable = [
        'anggota_id',
        'pinjaman_kelompok_id',
        'jpp_id',
        'nia',
        'tgl_proposal',
        'tgl_verifikasi',
        'tgl_dana',
        'tgl_cair',
        'tgl_lunas',
        'proposal',
        'verifikasi',
        'alokasi',
        'pros_jasa',
        'jangka',
        'sistem_angsuran',
        'status',
        'catatan_verifikasi',
        'catatan_bimbingan',
    ];

    protected $casts = [
        'tgl_proposal' => 'date',
        'tgl_verifikasi' => 'date',
        'tgl_dana' => 'date',
        'tgl_cair' => 'date',
        'tgl_lunas' => 'date',
        'proposal' => 'decimal:2',
        'verifikasi' => 'decimal:2',
        'alokasi' => 'decimal:2',
        'pros_jasa' => 'decimal:2',
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    public function pinjamanKelompok()
    {
        return $this->belongsTo(PinjamanKelompok::class);
    }
}
