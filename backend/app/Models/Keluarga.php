<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluarga extends Model
{
    use SoftDeletes;
    protected $table = 'keluarga';
    protected $fillable = ['kekeluargaan'];
}
