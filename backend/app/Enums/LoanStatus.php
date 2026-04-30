<?php

namespace App\Enums;

enum LoanStatus: string
{
    case PENGAJUAN = 'P';
    case VERIFIED = 'V';
    case WAITING = 'W';
    case AKTIF = 'A';
    case RESCHEDULING = 'R';
    case TIDAK_LAYAK = 'T';
    case LUNAS = 'L';
    case PENGHAPUSAN = 'H';
    case BLACKLIST = 'B';

    public function label(): string
    {
        return match($this) {
            self::PENGAJUAN => 'Pengajuan',
            self::VERIFIED => 'Verified',
            self::WAITING => 'Waiting',
            self::AKTIF => 'Aktif',
            self::RESCHEDULING => 'Rescheduling',
            self::TIDAK_LAYAK => 'Tidak Layak',
            self::LUNAS => 'Lunas',
            self::PENGHAPUSAN => 'Penghapusan',
            self::BLACKLIST => 'BlackList',
        };
    }
}
