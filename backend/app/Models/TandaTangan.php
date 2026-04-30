<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TandaTangan extends Model
{
    use SoftDeletes;
    protected $table = 'tanda_tangan';
    protected $fillable = [
        'nama',
        'jabatan',
        'tanda_tangan', // path to image or base64
        'kategori', // e.g., 'laporan', 'spk', 'kwitansi'
    ];
}
