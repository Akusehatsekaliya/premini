<?php

namespace App\Http\Controllers\user;

use App\Models\Film;
use App\Models\Kursi;
use App\Models\Tiket;
use App\Models\Tanggal;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

        // Ambil data nomor kursi yang telah diterima dari tabel pembayaran
        $kursiDiterima = Pembayaran::where('status', 'Diterima')
        ->pluck('nomor_kursi')
        ->flatMap(function ($item) {
            return explode(', ', $item);
        })
        ->toArray();

        // dd($kursiDiterima);

        return view('user.pilihkursi', compact('film', 'kursi', 'tikets', 'tanggal', 'jumlahTiket', 'hargaTiket', 'totalHarga', 'kursiDiterima'));
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
            'bukti' => 'required|file|image|mimes:jpg,jpeg,png',
        ]);

        $user = Auth::user();
        
        // Simpan file gambar ke storage
        $bukti = $request->file('bukti');
        $filename = uniqid() . '.' . $bukti->getClientOriginalExtension();
        $path = $bukti->storeAs('public/bukti', $filename);

        // Mengurangi stok tiket
        $tiket = Tiket::where('tiket', $validatedData['tiket'])->first();
        $tiket->stok -= $validatedData['jumlahTiket'];
        $tiket->save();

        // Simpan data ke tabel pembayaran
        $pembayaran = new Pembayaran([
            'judul' => $validatedData['judul'],
            'tiket' => $validatedData['tiket'],
            'jam' => $validatedData['jam'],
            'jumlah_tiket' => $validatedData['jumlahTiket'],
            'nomor_kursi' => $validatedData['nomor_kursi'],
            'total_harga' => $validatedData['total_harga'],
            'bukti' => $filename, // Simpan nama file gambar
        ]);

        // Memasukkan user_id ke dalam pembayaran
        $pembayaran->user_id = $user->id;

        // Menyimpan data pembayaran ke database
        $pembayaran->save();

        Session::flash('success', 'Anda Berhasil memesan tiket!');
        
        return redirect()->route('welcome');
    }
}