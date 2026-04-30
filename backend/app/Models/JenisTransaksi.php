<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisTransaksi extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_transaksi';
    protected $fillable = ['nama_jt'];
}
