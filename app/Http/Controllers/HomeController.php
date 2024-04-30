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
        $film = Film::get();
        if(auth()->check()) {
            if(auth()->user()->email == 'admin@gmail.com') {
                return view('admin.dashboard');
            } else {
                return view('welcome');
            }
        } else {
            return view('welcome');
        }
    }
}
