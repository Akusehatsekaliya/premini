<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Kursi;

class KursiController extends Controller
{
    public function kursi(){
        $kursi = Kursi::get();
        return view('admin.kursi.kursi', compact('kursi'));
    }

    public function proses_kursi(Request $request){
        $request->validate([
            'kursi' => 'required|unique:kursis,kursi'
        ],[
            'kursi.required' => 'kursi tidak boleh kosong',
            'kursi.uniqiu' => 'kursi sudah ada',
        ]);

        $kirim = Kursi::create([
            'kursi' => $request->kursi,
        ]);

        return back();
    }
}
