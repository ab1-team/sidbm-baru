<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'anggota';

    protected $fillable = [
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tgl_lahir',
        'alamat',
        'desa',
        'hp',
        'kk',
        'nik_penjamin',
        'nama_penjamin',
        'hubungan_penjamin',
        'usaha',
        'foto',
        'tgl_gabung',
        'status',
    ];

    protected $casts = [
        'tgl_lahir' => 'date',
        'tgl_gabung' => 'date',
    ];
}
