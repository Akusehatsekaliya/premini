<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Tiket;

class TiketController extends Controller
{
    public function tiket(){
        $tiket = Tiket::get();
        return view('admin.tiket.tiket', compact('tiket'));
    }

    public function proses_tiket(Request $request)
    {

        $request->validate([
            'tiket' => 'required',
            'stok'  => 'required',
        ], [
            'tiket.required' => 'Tiket tidak boleh kosong',
            'stok.required'  => 'Stok tidak boleh kosong',
        ]);

        $kirim = Tiket::create([
            'tiket' => $request->tiket,
            'stok' => $request->stok,
        ]);

        return back();
    }

    public function delete_tiket(Request $request, $id){
        $tiket = Tiket::find($id);
        $tiket->delete();

        return back();
    }

    public function update_tiket(Request $request, $id){

        $request->validate([
            'tiket' => 'required',
            'stok'  => 'required',
        ], [
            'tiket.required' => 'Tiket tidak boleh kosong',
            'stok.required'  => 'Stok tidak boleh kosong',
        ]);

        $tiket = Tiket::find($id);
        $tiket->tiket = $request->tiket;
        $tiket->stok = $request->stok;
        $tiket->save();

    return back();
    }
}
