<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisJasa extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_jasa';
    protected $fillable = ['nama_jj', 'deskripsi'];
}
