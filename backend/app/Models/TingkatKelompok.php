<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TingkatKelompok extends Model
{
    use SoftDeletes;
    protected $table = 'tingkat_kelompok';
    protected $fillable = ['nama_tk', 'deskripsi'];
}
