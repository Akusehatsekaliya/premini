<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        if(auth()->guest()) {
            return redirect()->route('login')->with('warning', 'Anda harus login terlebih dahulu');
        }

        return view('user.order');
    }
}
