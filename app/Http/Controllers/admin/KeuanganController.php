<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class KeuanganController extends Controller
{
    public function keuangan(){
        return view('admin.keuangan.keuangan');
    }
}   
