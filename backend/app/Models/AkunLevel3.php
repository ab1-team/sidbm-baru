<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AkunLevel3 extends Model
{
    use SoftDeletes;
    protected $table = 'akun_level3s';
    protected $fillable = ['kode', 'nama', 'parent_id', 'jenis_mutasi', 'no_rek_bank', 'atas_nama_rek'];

    public function parent()
    {
        return $this->belongsTo(AkunLevel2::class, 'parent_id');
    }
}
