<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinjamanKelompok extends Model
{
    use SoftDeletes;

    protected $table = 'pinjaman_kelompok';

    protected $fillable = [
        'kelompok_id',
        'pinjaman_ke',
        'jpp_id',
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
        'spk_no',
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

    public function kelompok()
    {
        return $this->belongsTo(Kelompok::class);
    }
}
