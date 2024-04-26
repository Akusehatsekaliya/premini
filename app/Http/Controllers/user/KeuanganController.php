<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KeuanganController extends Controller
{
    public function keuangan(){
        return view('admin.keuangan.keuangan');
    }
}
