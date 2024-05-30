<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = [
        "judul",
        "tiket",
        "jam",
        "jumlah_tiket",
        "nomor_kursi",
        "total_harga",
        "bukti",
        "user_id"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function Film()
    {
        return $this->belongsTo(Film::class);
    }

    public function Tiket()
    {
        return $this->belongsTo(Tiket::class);
    }

    public function Tanggal()
    {
        return $this->belongsTo(Tanggal::class);
    }

    public function Kursi()
    {
        return $this->belongsTo(Kursi::class);
    }
}
