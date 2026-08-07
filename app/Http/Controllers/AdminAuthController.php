<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([

            'email' => 'required|email',
            'password' => 'required',

        ]);

        if (Auth::attempt($data)) {

            $request->session()->regenerate();

            return redirect('/dashboard');
        }

return redirect()
    ->route('login')
    ->withInput()
    ->with('error', 'البريد الإلكتروني أو كلمة المرور خطأ');  
    
    }

public function logout(Request $request)
{
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect()->route('login');
}
}
