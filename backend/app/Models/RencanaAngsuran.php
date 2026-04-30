<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RencanaAngsuran extends Model
{
    use SoftDeletes;

    protected $table = 'rencana_angsuran';

    protected $fillable = [
        'pinjaman_kelompok_id',
        'pinjaman_anggota_id',
        'angsuran_ke',
        'jatuh_tempo',
        'wajib_pokok',
        'wajib_jasa',
        'target_pokok',
        'target_jasa',
    ];

    protected $casts = [
        'jatuh_tempo' => 'date',
        'wajib_pokok' => 'decimal:2',
        'wajib_jasa' => 'decimal:2',
        'target_pokok' => 'decimal:2',
        'target_jasa' => 'decimal:2',
    ];
}
