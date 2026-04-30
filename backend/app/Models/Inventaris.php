<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventaris extends Model
{
    use SoftDeletes;

    protected $table = 'inventaris';

    protected $fillable = [
        'nama_barang',
        'tgl_beli',
        'unit',
        'harga_satuan',
        'umur_ekonomis',
        'status',
    ];

    protected $casts = [
        'tgl_beli' => 'date',
        'harga_satuan' => 'decimal:2',
    ];
}
