<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggal extends Model
{
   protected $fillable = [
    'hari',
    'tanggal',
    'jam',
   ];
}
