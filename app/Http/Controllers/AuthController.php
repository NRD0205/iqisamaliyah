<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nisn'     => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan NISN di Supabase
        $user = User::where('nisn', $request->nisn)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'nisn' => 'NISN atau password salah.',
            ])->withInput(['nisn' => $request->nisn]);
        }

        // Login dan buat session
        Auth::login($user);

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}