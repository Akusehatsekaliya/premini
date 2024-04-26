<?php

namespace App\Http\Controllers\admin;

use App\Models\Film;
use App\Models\Kursi;
use App\Models\Tanggal;
use App\Models\Tiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class FilmController extends Controller
{
    public function film(){
        $film = Film::get();
        $kursi = Kursi::get();
        $tiket = Tiket::get();
        $tanggal = Tanggal::get();

        return view('admin.film.film', compact('film', 'kursi', 'tiket', 'tanggal'));
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function proses_film(Request $request){


        $request->validate([
            'judul'        => 'required',
            'film'         => 'required',
            'kursi_id'     => 'required',
            'tanggal'      => 'required',
            'deskripsi'    => 'required',
        ],[
            'judul.required'       => 'Tidak boleh kosong',
            'film.required'        => 'Tidak boleh kosong',
            'kursi_id.required'    => 'Tidak boleh kosong',
            'tanggal.required'     => 'Tidak boleh kosong',
            'deskripsi.required'   => 'Tidak boleh kosong',
        ]);


        $film = $request->file('film');
        $extension = $film->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $path = 'vidio/'.$filename;
        Storage::disk('public')->put($path,file_get_contents($film));

        $akses = Film::create([
            'judul'      => $request->judul,
            'film'       => $filename,
            'deskripsi'  => $request->deskripsi,
            'kursi_id'   => $request->kursi_id,
            'tanggal'    => $request->tanggal,
        ]);

        return back();
    }

    public function delete_film(Request $request, $id)
    {
        $deletefilm = Film::find($id);

        if ($deletefilm) {
            // Hapus file foto terkait jika ada
            $vidioPath = public_path('storage/vidio/' . $deletefilm->film);
            if (file_exists($vidioPath)) {
                unlink($vidioPath);
            }

            // Hapus objek alat dari basis data
            $deletefilm->delete();
        }

        return back();
    }

    public function update_film(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required',
            'film'       => 'required',
            'deskripsi'  => 'required',
            'kursi_id'   => 'required',
            'tanggal'    => 'required',
        ],[
            'judul.required'         => 'Tidak boleh kosong',
            'film.required'          => 'Tidak boleh kosong',
            'deskripsi.required'     => 'Tidak boleh kosong',
            'kursi_id.required'      => 'Tidak boleh kosong',
            'tanggal.required'       => 'Tidak boleh kosong',
        ]);


        $film = Film::find($id);

        if ($film) {
            if ($request->hasFile('film')) {
                // Hapus file video lama jika ada
                Storage::disk('public')->delete('vidio/' . $film->film);

                // Upload video baru
                $video = $request->file('film');
                $extension = $video->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;
                $path = 'vidio/' . $filename;
                Storage::disk('public')->put($path, file_get_contents($video));

                $film->film = $filename;
            }

            // Perbarui data film
            $film->update($request->except('film'));
        }

        return redirect()->route('adminfilm');
    }
}
