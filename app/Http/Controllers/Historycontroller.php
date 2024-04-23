<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Historycontroller extends Controller
{
    public function index()
    {
        return view('user.history');
    }
}
