<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $fillable = [
        "judul",
        "film",
        "kursi_id",
        "tiket_id",
        "tanggal",
        "deskripsi",
        "tanggal_id"
    ];

    public function Kursi(){
        return $this->belongsTo(Kursi::class);
    }
    public function Tiket(){
        return $this->belongsTo(Tiket::class);
    }
    public function Tanggal(){
        return $this->belongsTo(Tanggal::class);
    }
}
