<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Film;

class FilmController extends Controller
{
    public function film(){
        $film = Film::get();
        return view('admin.film.film', compact('film'));
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function proses_film(Request $request){

        $request->validate([
            'judul' => 'required',
            'film' => 'required'
        ],[
            'judul.required' => 'Tidak boleh kosong',
            'film.required'  => 'Tidak boleh kosong',
            'film.mimes'     => 'Format file harus berupa MP4',
            'film.max'       => 'Ukuran file melebihi batas maksimum (2GB)'
        ]);

        $film = $request->file('film');
        $extension = $film->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $path = 'vidio/'.$filename;
        Storage::disk('public')->put($path,file_get_contents($film));

        $akses = Film::create([
            'judul' => $request->judul,
            'film' => $filename,
        ]);

        return redirect()->route('adminfilm');
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
            'judul' => 'required',
            'film' => 'required'
        ], [
            'judul.required' => 'Tidak boleh kosong',
            'film.required' => 'Tidak boleh kosong',
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
            $film->update($request->except('img'));
        }

        return redirect()->route('adminfilm');
    }
}

