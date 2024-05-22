<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Models\Film;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(auth()->check()) {
            if(auth()->user()->email == 'admin@gmail.com') {
                return view('admin.dashboard');
            } else {
                $film = Film::paginate(10); // Ambil data film jika pengguna terautentikasi dan bukan admin
                return view('welcome', compact('film'));
            }
        } else {
            $film = Film::paginate(10); // Ambil data film jika pengguna tidak terautentikasi
            return view('welcome', compact('film'));
        }
    }

    public function search(Request $request)
    {
        // Lakukan pencarian berdasarkan judul film
        $keyword = $request->input('keyword');
        $films = Film::where('judul', 'like', "%$keyword%")->get();

        // Jika tidak ada film yang ditemukan, kembalikan daftar film yang sudah ada
        if ($films->isEmpty()) {
            $films = Film::paginate(5); // Ambil daftar film dengan paginasi
            return view('welcome')->with('film', $films);
        }

        // Jika film ditemukan, tampilkan hasil pencarian
        return view('welcome')->with('film', $films);
    }
}
