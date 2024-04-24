<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Kursi;
use App\Models\Tiket;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $film = Film::get();
        $tiket = Tiket::get();
        $kursi = Kursi::get();

        if(auth()->guest()) {
            return redirect()->route('login')->with('warning', 'Anda harus login terlebih dahulu');
        }

        return view('user.order', compact('film','tiket', 'kursi'));
    }
}
