<?php

namespace App\Http\Controllers\user;

use App\Models\Film;
use App\Models\Keuangan;
use App\Models\Kursi;
use App\Models\Order;
use App\Models\Tiket;
use App\Models\Tanggal;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
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
        $tanggal = Tanggal::where('film_id', $id)->get();

        $jumlahTiket = session('jumlahTiket', 0);
        $selectedTicketId = $request->input('tiket');
        $selectedTicket = $selectedTicketId ? Tiket::find($selectedTicketId) : null;
        $hargaTiket = $selectedTicket ? $selectedTicket->harga : 0;

        $totalHarga = $hargaTiket * $selectedTicketId;

        return view('user.pilihkursi', compact('film', 'kursi', 'tikets', 'tanggal', 'jumlahTiket', 'hargaTiket','totalHarga'));
    }


    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string',
            'tiket' => 'required|string',
            'jam' => 'required',
            'jumlahTiket' => 'required|integer',
            'nomorKursi' => 'required|string',
            'total_harga' => 'required|string',
        ]);

        // Simpan data ke tabel pembayaran
        Pembayaran::create([
            'judul' => $request->judul,
            'tiket' => $request->tiket,
            'jam' => $request->jam,
            'jumlah_tiket' => $request->jumlahTiket,
            'nomor_kursi' => $request->nomorKursi,
            'total_harga' => $request->total_harga,
        ]);

        return redirect()->route('/')->with('success', 'Pembayaran berhasil disimpan.');
    }
}