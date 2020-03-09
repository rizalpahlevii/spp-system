<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:web')->except('logout');
        $this->middleware('guest:siswa')->except('logout');
    }
    protected function guard()
    {
        return Auth::guard('web');
    }
    public function showAdminLoginForm()
    {
        return view('auth.customLogin', ['url' => 'admin']);
    }
    public function adminLogin(Request $request)
    {
        if (Auth::guard('web')->check() or Auth::guard('siswa')->check()) {
            return redirect()->back();
        }
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:5'
        ]);
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            $credentials = ['email' => $request->email, 'password' => $request->password];
        } else {
            $credentials = ['username' => $request->email, 'password' => $request->password];
        }
        if (Auth::guard('web')->attempt($credentials, $request->get('remember'))) {
            return redirect()->intended('/admin/dashboard');
        }
        session()->flash('message', 'Email atau password salah!');
        return back()->withInput($request->only('email', 'remember'));
    }
    public function showSiswaLoginForm()
    {
        if (Auth::guard('web')->check() or Auth::guard('siswa')->check()) {
            return redirect()->back();
        }
        return view('auth.customLogin', ['url' => 'siswa']);
    }
    public function siswaLogin(Request $request)
    {
        $request->validate([
            'nis' => 'required|min:6',
            'password' => 'required|min:5'
        ]);
        if (Auth::guard('siswa')->attempt(['nis' => $request->nis, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/siswa');
        }
        session()->flash('message', 'Nis atau password salah!');
        return back()->withInput($request->only('nis', 'remember'));
    }
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            $redirect = '/login/admin';
        } else {
            $redirect = '/login/siswa';
        }
        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Auth::logout();
        return redirect($redirect);
    }
}
