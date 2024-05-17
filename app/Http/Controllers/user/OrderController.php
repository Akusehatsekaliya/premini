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


    public function detail($id)
    {
        $film = Film::find($id);

        return view('user.detail', compact('film'));
    }

    public function pilihkursi(Request $request, $id)
    {
        $film = Film::findOrFail($id);
        $kursi = Kursi::where('id', $id)->select('kursi')->first();
        $tikets = Tiket::where('film_id', $id)->get();
        $tanggal = Tanggal::get();

        $jumlahTiket = session('jumlahTiket', 0);
        $hargaTiket = $tikets->isNotEmpty() ? $tikets->first()->harga + $kursi->kursi: 0;

        return view('user.pilihkursi', compact('film', 'kursi', 'tikets', 'tanggal', 'jumlahTiket', 'hargaTiket'));
    }

    public function tambah_pembayaran(Request $request){
        $request->validate([
            'nama' => 'required',
            'noHp' => 'required',
            ''
        ]);
    }
}
