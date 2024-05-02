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
    public function index()
    {
        if(auth()->check()) {
            if(auth()->user()->email == 'admin@gmail.com') {
                return view('admin.dashboard');
            } else {
                $film = Film::paginate(2); // Ambil data film jika pengguna terautentikasi dan bukan admin
                return view('welcome', compact('film'));
            }
        } else {
            $film = Film::paginate(2); // Ambil data film jika pengguna tidak terautentikasi
            return view('welcome', compact('film'));
        }
    }
}
