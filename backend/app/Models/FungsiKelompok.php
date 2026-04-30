<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FungsiKelompok extends Model
{
    use SoftDeletes;
    protected $table = 'fungsi_kelompok';
    protected $fillable = ['nama_fgs', 'deskripsi'];
}
