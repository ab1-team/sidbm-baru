<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisUsaha extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_usaha';
    protected $fillable = ['nama_ju', 'deskripsi'];
}
