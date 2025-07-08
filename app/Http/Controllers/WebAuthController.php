<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WebAuthController extends Controller
{
    private $adminCredentials = [
        'username' => 'admin123',
        'password' => '0000'
    ];

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (
            $request->username === $this->adminCredentials['username'] &&
            $request->password === $this->adminCredentials['password']
        ) {
            Session::put('is_admin', true);
            return redirect()->route('dashboard');
        }

        return back()->with('error', 'Username atau Password salah.');
    }

    public function logout()
    {
        Session::forget('is_admin');
        return redirect()->route('login');
    }
}
