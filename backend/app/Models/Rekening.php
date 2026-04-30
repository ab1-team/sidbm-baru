<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    protected $table = 'rekenings';
    protected $primaryKey = 'kode_akun';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_akun',
        'parent_id',
        'lev1',
        'lev2',
        'lev3',
        'lev4',
        'nama_akun',
        'jenis_mutasi',
        'tgl_nonaktif',
        'saldo_awal',
    ];

    protected $casts = [
        'tgl_nonaktif' => 'date',
    ];
}
