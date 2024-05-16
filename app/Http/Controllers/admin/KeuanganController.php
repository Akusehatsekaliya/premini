<?php

namespace App\Http\Controllers\admin;

use App\Models\Keuangan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KeuanganController extends Controller
{
    public function keuangan(){
        $pembayaran = Keuangan::all();
        return view('admin.keuangan.keuangan', compact('pembayaran'));
    }
}
