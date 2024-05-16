<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

use App\Models\Film;
use App\Models\Tanggal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class TanggalController extends Controller
{
    public function tanggal()
    {
        $film = Film::get();
        $tanggal = Tanggal::get();
        return view('admin.tanggal.tanggal', compact('tanggal', 'film'));
    }

    public function proses_tanggal(Request $request)
    {
        $request->validate([
            'film_id' => 'required',
            'tanggal' => 'required|date_format:Y-m-d',
            'jam' => 'required|date_format:H:i'
        ], [
            'film_id.required' => 'film tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'tanggal.date_format' => 'Format tanggal harus Y-m-d',
            'jam.required' => 'Jam tidak boleh kosong',
            'jam.date_format' => 'Format jam harus H:i'
        ]);

        $kirim = Tanggal::create([
            'film_id' => $request->film_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam
        ]);

        Session::flash('successTambah', 'Data berhasil ditambahkan!');

        return back();
    }

    public function delete_tanggal(Request $request, $id)
    {
        $tanggal = Tanggal::find($id);
        $tanggal->delete();

        Session::flash('successHapus', 'Data berhasil dihapus!');

        return back();
    }

    public function update_tanggal(Request $request, $id)
    {
        $tanggal = Tanggal::find($id);

        $request->validate([
            'film_id' => 'required',
            'tanggal' => 'required',
            'jam' => 'required'
        ], [
            'film_id.required' => 'Hari tidak boleh kosong',
            'tanggal.required' => 'Tanggal tidak boleh kosong',
            'jam.required' => 'Jam tidak boleh kosong',

        ]);

        $data = [
            'film_id' => $request->film_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
        ];
        $tanggal->update($data);

        // $tanggal = Tanggal::find($id);
        // $tanggal['hari'] = $request->hari;
        // $tanggal['tanggal'] = $request->tanggal;
        // $tanggal['jam'] = $request->jam;
        // $tanggal->save();

        Session::flash('successEdit', 'Data berhasil diubah!');

        return back();
    }
}
