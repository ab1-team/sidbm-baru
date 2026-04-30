<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi';
    protected $primaryKey = 'idt';

    protected $fillable = [
        'tgl_transaksi',
        'rekening_debit',
        'rekening_kredit',
        'idtp',
        'id_pinj',
        'id_pinj_i',
        'keterangan_transaksi',
        'relasi',
        'jumlah',
        'urutan',
        'id_user',
    ];

    protected $casts = [
        'tgl_transaksi' => 'date',
        'jumlah' => 'decimal:2',
    ];
}
