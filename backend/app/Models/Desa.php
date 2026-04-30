<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Desa extends Model
{
    use SoftDeletes;
    protected $table = 'desa';
    protected $fillable = [
        'kd_desa',
        'nama_desa',
        'alamat_desa',
        'telp_desa',
        'kades',
        'sekdes',
    ];
}
