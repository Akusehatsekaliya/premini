<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $fillable = [
        'film_id',
        'tiket',
        'stok',
        'harga'
    ];

    public function Film(){
        return $this->belongsTo(Film::class);
    }

    public function Pembayaran(){
        return $this->belongsTo(Pembayaran::class);
    }
}
