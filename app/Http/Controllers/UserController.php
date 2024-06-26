<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function profile()
    {
        $user = User::first();

        return view('user.profile')->with('user', $user);
    }
}
