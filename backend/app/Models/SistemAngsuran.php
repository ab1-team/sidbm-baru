<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SistemAngsuran extends Model
{
    use SoftDeletes;
    protected $table = 'sistem_angsuran';
    protected $fillable = ['nama_sa', 'deskripsi'];
}
