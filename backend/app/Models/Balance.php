<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $table = 'balances';
    public $incrementing = false;

    protected $fillable = [
        'id',
        'kode_akun',
        'tahun',
        'debit_01', 'kredit_01',
        'debit_02', 'kredit_02',
        'debit_03', 'kredit_03',
        'debit_04', 'kredit_04',
        'debit_05', 'kredit_05',
        'debit_06', 'kredit_06',
        'debit_07', 'kredit_07',
        'debit_08', 'kredit_08',
        'debit_09', 'kredit_09',
        'debit_10', 'kredit_10',
        'debit_11', 'kredit_11',
        'debit_12', 'kredit_12',
    ];
}
