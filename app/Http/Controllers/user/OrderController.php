<?php

namespace App\Http\Controllers\user;

use App\Models\Film;
use App\Models\Keuangan;
use App\Models\Kursi;
use App\Models\Map;
use App\Models\Order;
use App\Models\Tiket;
use App\Models\Tanggal;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
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

        // Inisialisasi nilai jumlah tiket dan harga tiket
        $jumlahTiket = $request->session()->get('jumlahTiket', 0);
        $selectedTicketId = $request->input('tiket');
        $selectedTicket = $selectedTicketId ? Tiket::find($selectedTicketId) : null;
        $hargaTiket = $selectedTicket ? $selectedTicket->harga : 0;

        // Perhitungan total harga
        $totalHarga = $hargaTiket * $jumlahTiket;

        return view('user.pilihkursi', compact('film', 'kursi', 'tikets', 'tanggal', 'jumlahTiket', 'hargaTiket', 'totalHarga'));
    }

    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'tiket' => 'required|string',
            'jam' => 'required',
            'jumlahTiket' => 'required|integer',
            'nomor_kursi' => 'required|string',
            'total_harga' => 'required|string',
        ]);

        $user = Auth::user();
        $totalHarga = $request->total_harga;

        // Periksa apakah saldo cukup
        if ($user->saldo < $totalHarga) {
            return redirect()->back()->with('error', 'Saldo anda tidak mencukupi');
        }

        // Lakukan pengurangan saldo
        $user->saldo -= $totalHarga;
        $user->save();
        // dd($validatedData);

        // Simpan data ke tabel pembayaran
        Pembayaran::create([
            'judul' => $validatedData['judul'],
            'tiket' => $validatedData['tiket'],
            'jam' => $validatedData['jam'],
            'jumlah_tiket' => $validatedData['jumlahTiket'],
            'nomor_kursi' => $validatedData['nomor_kursi'],
            'total_harga' => $validatedData['total_harga'],
        ]);

        Session::flash('success', 'Anda Berhasil memesan tiket!');

        return redirect()->route('welcome');
    }
}