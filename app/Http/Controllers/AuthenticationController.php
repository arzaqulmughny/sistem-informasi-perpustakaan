<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    /**
     * Login page
     */
    public function index()
    {
        return view('login.index');
    }

    /**
     * User login
     */
    public function authenticate(UserLoginRequest $request)
    {
        // Attempt login
        if (Auth()->attempt($request->only(['email', 'password']), $request->remember)) {
            $request->session()->regenerate();

            return redirect()->intended('dashboard');
        } else {
            // Login fails
            return back()->withErrors([
                'email' => 'Data yang Anda masukkan tidak tersedia pada sistem kami.',
            ])->onlyInput('email');
        }
    }

    /**
     * User logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate();
        $request->session()->regenerate();
     
        return redirect('/');
    }
}
