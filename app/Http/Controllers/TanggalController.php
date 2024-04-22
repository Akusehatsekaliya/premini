<?php

namespace App\Http\Controllers;

use App\Models\Tanggal;
use Illuminate\Http\Request;

class TanggalController extends Controller
{
    public function tanggal(){
        $tanggal = Tanggal::get();
        return view('admin.tanggal.tanggal', compact('tanggal'));
    }

    public function proses_tanggal(Request $request) {
        $request->validate([
            'hari' => 'required',
            'tanggal' => 'required|date_format:Y-m-d',
            'jam' => 'required|date_format:H:i'
        ], [
            'hari.required' => 'Hari tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date_format' => 'Format tanggal harus Y-m-d',
            'jam.required' => 'Jam tidak boleh kosong',
            'jam.date_format' => 'Format jam harus H:i'
        ]);

        $kirim = Tanggal::create([
            'hari' => $request->hari,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
        ]);

        return back();
    }

    public function delete_tanggal(Request $request, $id){
        $tiket = Tanggal::find($id);
        $tiket->delete();

        return back();
    }
}
