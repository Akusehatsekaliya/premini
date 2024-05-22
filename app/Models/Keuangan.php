<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $fillable = [
        'judul',
        'tiket',
        'tanggal',
        'jam',
        'jumlah_tiket',
        'nomor_kursi',
        'total_harga'
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