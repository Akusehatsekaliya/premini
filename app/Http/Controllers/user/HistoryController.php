<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Order;

class HistoryController extends Controller
{
    public function index()
    {
        $order = Order::get();

        if(auth()->guest()) {
            return redirect()->route('login')->with('warning', 'Anda harus login terlebih dahulu');
        }
        
        return view('user.tiket.history', compact('order'));
    }
}
