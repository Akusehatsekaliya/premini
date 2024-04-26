<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Atribut pembayaran
    public const E_WALLET = 'e-wallet';
    public const BANK = 'bank';

    // Metode untuk mendapatkan opsi pembayaran
    public static function getOptions()
    {
        return [
            self::E_WALLET => 'E-Wallet',
            self::BANK => 'Bank',
        ];
    }
}
