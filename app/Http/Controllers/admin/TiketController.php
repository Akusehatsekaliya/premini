<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

use App\Models\Film;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TiketController extends Controller
{
    public function tiket(){
        $tiket = Tiket::get();
        $film  = Film::get();
        return view('admin.tiket.tiket', compact('tiket', 'film'));
    }

    public function proses_tiket(Request $request)
    {

        $request->validate([
            'tiket' => 'required',
            'stok'  => 'required|min:1|max:50',
            'film_id' => 'required',
            'harga'   => 'required|min:1|max:100000'
        ], [
            'tiket.required' => 'Tiket tidak boleh kosong',
            'stok.required'  => 'Stok tidak boleh kosong',
            'film_id.required'  => 'nama tidak boleh kosong',
            'harga.required'  => 'harga tidak boleh kosong',
            'harga.min' => 'minimal 1.000',
            'harga.max' => 'maksimal 100.000'
        ]);

        $kirim = Tiket::create([
            'tiket' => $request->tiket,
            'stok' => $request->stok,
            'film_id' => $request->film_id,
            'harga'  => $request->harga,
        ]);

        Session::flash('successTambah', 'Data berhasil ditambahkan!');

        return back();
    }

    public function delete_tiket(Request $request, $id){
        $tiket = Tiket::find($id);
        $tiket->delete();

        Session::flash('successHapus', 'Data berhasil dihapus!');

        return back();
    }

    public function update_tiket(Request $request, $id){

        $request->validate([
            'tiket' => 'required',
            'stok'  => 'required',
            'film_id' => 'required',
            'harga'   => 'required',
        ], [
            'tiket.required' => 'Tiket tidak boleh kosong',
            'stok.required'  => 'Stok tidak boleh kosong',
            'film_id.required'  => 'nama film tidak boleh kosong',
            'harga.required'  => 'harga tidak boleh kosong',
        ]);

        $tiket = Tiket::find($id);
        $tiket->tiket = $request->tiket;
        $tiket->stok = $request->stok;
        $tiket->film_id = $request->film_id;
        $tiket->harga   = $request->harga;
        $tiket->save();

        Session::flash('successEdit', 'Data berhasil diubah!');

        return back();
    }
}
