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
            'maps.*' => 'required|url',
            'nama_lokasi.*' => 'required|string',
        ]);

        // Memeriksa apakah jumlah elemen dalam $request->maps sama dengan jumlah elemen dalam $request->nama_lokasi
        if (count($request->maps) === count($request->nama_lokasi)) {
            foreach ($request->maps as $index => $map) {
                Map::create([
                    'map' => $map,
                    'nama_lokasi' => $request->nama_lokasi[$index], // Simpan nama lokasi yang sesuai dengan indeksnya
                ]);
            }

            Session::flash('successTambah', 'Data berhasil ditambahkan!');
        } else {
            Session::flash('errorTambah', 'Jumlah nama lokasi tidak sesuai dengan jumlah link map!');
        }

        return back();
    }

    public function update_map(Request $request, $id)
    {
        $request->validate([
            'map' => 'required|url',
            'nama_lokasi' => 'required|string', // Validasi untuk nama_lokasi
        ]);

        $map = Map::find($id);

        $data = [
            'map' => $request->map,
            'nama_lokasi' => $request->nama_lokasi, // Update nama_lokasi
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

