<?php

namespace App\Http\Controllers\admin;

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
             return back();
    }

    public function delete_map(Request $request, $id){
        $tiket = Map::find($id);
        $tiket->delete();

        return back();
    }

}

