<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ebudgeting extends Model
{
    use SoftDeletes;

    protected $table = 'ebudgeting';

    protected $fillable = [
        'kode_akun',
        'tahun',
        'bulan',
        'jumlah',
    ];

    protected $casts = [
        'jumlah' => 'decimal:2',
    ];
}
