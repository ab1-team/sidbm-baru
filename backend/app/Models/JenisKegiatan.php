<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JenisKegiatan extends Model
{
    use SoftDeletes;
    protected $table = 'jenis_kegiatan';
    protected $fillable = ['nama_jk', 'deskripsi'];
}
