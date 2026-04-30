<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RealAngsuran extends Model
{
    use SoftDeletes;

    protected $table = 'real_angsuran';

    protected $fillable = [
        'pinjaman_kelompok_id',
        'pinjaman_anggota_id',
        'tgl_transaksi',
        'realisasi_pokok',
        'realisasi_jasa',
        'saldo_pokok',
        'saldo_jasa',
    ];

    protected $casts = [
        'tgl_transaksi' => 'date',
        'realisasi_pokok' => 'decimal:2',
        'realisasi_jasa' => 'decimal:2',
        'saldo_pokok' => 'decimal:2',
        'saldo_jasa' => 'decimal:2',
    ];
}
