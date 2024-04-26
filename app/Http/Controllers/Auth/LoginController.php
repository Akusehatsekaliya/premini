<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);        

        // Periksa apakah email terdaftar
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            // Jika email belum terdaftar, tambahkan pesan kesalahan
            return redirect()->back()->withErrors([
                'email' => 'Email belum terdaftar',
            ]);
        }

        // Lakukan login pengguna jika email dan password valid
        if (Auth::attempt($request->only('email', 'password'), $request->remember)) {
            return redirect()->intended('/');
        } else {
            if (User::where('email', $request->email)->exists()) {
                return redirect()->back()->withErrors([
                    'password' => 'Kata sandi salah',
                ])->withInput($request->except('password'));
            } else {
                return redirect()->back()->withErrors([
                    'email' => 'Email belum terdaftar',
                ])->withInput($request->except('password'));
            }
        }
    }
}
