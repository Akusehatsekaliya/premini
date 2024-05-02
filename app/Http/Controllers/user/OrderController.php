<?php

namespace App\Http\Controllers\user;

use App\Models\Film;
use App\Models\Kursi;
use App\Models\Tiket;
use App\Models\Tanggal;
use Illuminate\Routing\Controller;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $film = Film::get();
        $tiket = Tiket::get();
        $tanggal = Tanggal::get();
        $kursi = Kursi::get();

        if(auth()->guest()) {
            return redirect()->route('login')->with('warning', 'Anda harus login terlebih dahulu');
        }

        return view('user.order', compact('film','tiket','tanggal','kursi'));
    }
}
