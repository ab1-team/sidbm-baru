<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelompok extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kelompok';

    protected $fillable = [
        'kd_kelompok',
        'nama_kelompok',
        'jpp_id',
        'desa',
        'alamat_kelompok',
        'telpon',
        'tgl_berdiri',
        'ketua',
        'sekretaris',
        'bendahara',
        'status',
    ];

    protected $casts = [
        'tgl_berdiri' => 'date',
    ];
}
