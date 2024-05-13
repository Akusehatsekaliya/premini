<?php

namespace App\Http\Controllers\admin;
use Illuminate\Support\Facades\Session;

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

    public function proses_film(Request $request)
    {
        $request->validate([
            'judul'        => 'required',
            'film'         => 'required|file|mimes:jpg,jpeg,png', // Menambahkan validasi file
            'kursi_id'     => 'required',
            'deskripsi'    => 'required',
        ],[
            'judul.required'       => 'Judul tidak boleh kosong',
            'film.required'        => 'File tidak boleh kosong',
            'film.mimes'           => 'Format file tidak valid. Harus berupa mp4, mov, avi, atau wmv',
            'kursi_id.required'    => 'Kursi ID tidak boleh kosong',
            'deskripsi.required'   => 'Deskripsi tidak boleh kosong',
        ]);

        $film = $request->file('film');

        // Generate nama file yang unik
        $filename = uniqid() . '.' . $film->getClientOriginalExtension();

        // Simpan file ke dalam direktori penyimpanan
        $path = $film->storeAs('public/vidio', $filename);

        $akses = Film::create([
            'judul'      => $request->judul,
            'film'       => $filename,
            'deskripsi'  => $request->deskripsi,
            'kursi_id'   => $request->kursi_id,
        ]);

        // Set pesan sukses
        Session::flash('successTambah', 'Film berhasil ditambahkan!');

        return back();
    }

    public function delete_film(Request $request, $id)
{
    $deletefilm = Film::find($id);

    if ($deletefilm) {
        // Periksa apakah data masih digunakan sebelum menghapus
        $isDataUsed = $this->checkDataUsage($deletefilm);

        if ($isDataUsed) {
            // Tampilkan alert error jika data masih digunakan
            Session::flash('errorHapus', 'Data tidak dapat dihapus karena masih digunakan!');
        } else {
            // Hapus file foto terkait jika ada
            $vidioPath = public_path('storage/vidio/' . $deletefilm->film);
            if (file_exists($vidioPath)) {
                unlink($vidioPath);
            }

            // Hapus objek film dari basis data
            $deletefilm->delete();
            Session::flash('successHapus', 'Data berhasil dihapus!');
        }
    }

    return back();
}

private function checkDataUsage($film)
{
    // Implementasikan logika pemeriksaan penggunaan data di sini
    // Misalnya, periksa apakah film masih digunakan oleh entitas lain
    // Jika masih digunakan, kembalikan nilai true; jika tidak, kembalikan nilai false

    // Contoh implementasi sederhana
    $isUsed = false;

    // Periksa apakah film digunakan oleh entitas lain, misalnya, tabel Tiket
    $tikets = Tiket::where('film_id', $film->id)->get();
    if ($tikets->count() > 0) {
        $isUsed = true;
    }

    return $isUsed;
}

    public function update_film(Request $request, $id)
    {
        $request->validate([
            'judul'      => 'required',
            'film'       => 'required',
            'deskripsi'  => 'required',
            'kursi_id'   => 'required',
        ],[
            'judul.required'         => 'Tidak boleh kosong',
            'film.required'          => 'Tidak boleh kosong',
            'deskripsi.required'     => 'Tidak boleh kosong',
            'kursi_id.required'      => 'Tidak boleh kosong',
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

        Session::flash('successEdit', 'Data berhasil diubah!');
        return redirect()->route('adminfilm');
    }
}
