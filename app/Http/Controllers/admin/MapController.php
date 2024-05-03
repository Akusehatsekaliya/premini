<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

use App\Models\Map;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class MapController extends Controller
{
    public function map(){
        $map = Map::get();
        return view('admin.map.map', compact('map'));
    }
    public function tambah_map(Request $request)
    {
        $request->validate([
            'map' => 'required|url', // Validasi bahwa input harus berupa URL
        ]);

        $kirim = Map::create([
            'map' => $request->map
        ]);

        Session::flash('successTambah', 'Data berhasil ditambahkan!');

        return back();
    }

    public function update_map(Request $request, $id){
        $request->validate([
            'map' => 'required|url', // Validasi bahwa input harus berupa URL
        ]);

        $map = Map::find($id);

        $data = [
            'map' => $request->map,
            ];
             $map->update($data);

             Session::flash('successEdit', 'Data berhasil diubah!');

             return back();
    }

    public function delete_map(Request $request, $id){
        $tiket = Map::find($id);
        $tiket->delete();

        Session::flash('successHapus', 'Data berhasil dihapus!');
        
        return back();
    }

}

