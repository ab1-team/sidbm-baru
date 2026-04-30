<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunLevel1 extends Model
{
    use SoftDeletes;
    protected $table = 'akun_level1s';
    protected $fillable = ['kode', 'nama', 'parent_id', 'jenis_mutasi', 'no_rek_bank', 'atas_nama_rek'];
}
