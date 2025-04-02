<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LoginLog;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (session()->has('temp_login')) {
            Auth::logout();
            session()->forget('temp_login'); 
            return redirect('/login')->with('info', 'Session expired, please log in again.');
        }

        if (Auth::check()) {
            return Auth::user()->jenis === 'admin' ? redirect('/admin') : redirect('/guest');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $user = Auth::user();

            if (!$remember) {
                session()->put('temp_login', true);
            } else {
                session()->forget('temp_login');
            }

            LoginLog::create([
                'user_id' => $user->id,
                'login_at' => now(),
            ]);

            return redirect()->intended($user->jenis === 'admin' ? '/admin' : '/guest')
                ->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}
