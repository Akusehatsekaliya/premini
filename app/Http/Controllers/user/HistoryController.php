<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembayaran;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil data pembayaran yang terkait dengan user_id pengguna yang masuk
        $pembayaran = Pembayaran::where('user_id', Auth::id())->get();

        // Jika pengguna belum login, redirect ke halaman login
        if (Auth::guest()) {
            return redirect()->route('login')->with('warning', 'Anda harus login terlebih dahulu');
        }

        return view('user.tiket.history', compact('pembayaran'));
    }
}
