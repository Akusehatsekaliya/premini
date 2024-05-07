<?php

namespace App\Http\Controllers\user;

use App\Models\Film;
use App\Models\Kursi;
use App\Models\Order;
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

    public function detail()
    {
        $film = Film::get();

        return view('user.detail', compact('film'));
    }

    public function pesan(Request $request)
    {
        $film = Film::get();
        $tiket = Tiket::get();
        $tanggal = Tanggal::get();

        $jumlahTiket = $request->input('jumlah');
        
        // Validasi jumlah tiket
        if ($jumlahTiket > 10) {
            return redirect()->back()->with('error', 'Jumlah tiket tidak boleh lebih dari 10.');
        }

        session(['jumlahTiket' => $jumlahTiket]);

        return view('user.pesan', compact('film', 'tiket', 'tanggal', 'jumlahTiket'));
    }


    public function pilihkursi(Request $request)
    {
        $film = Film::first();
        $kursi = Kursi::all();
        $tiket = Tiket::first();
        $tanggal = Tanggal::first();

        $jumlahTiket = session('jumlahTiket');
        $hargaTiket = $tiket->harga;

        return view('user.pilihkursi', compact('film','kursi','tiket','tanggal','jumlahTiket','hargaTiket'));
    }
}
