<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Pembayaran;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $pembayaran = Pembayaran::all();

        if(auth()->guest()) {
            return redirect()->route('login')->with('warning', 'Anda harus login terlebih dahulu');
        }
        
        return view('user.tiket.history', compact('pembayaran'));
    }
}
