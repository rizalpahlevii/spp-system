<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Siswa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function dashboard()
    {
        $data = [
            'count_siswa' => Siswa::all()->count(),
            'count_kelas' => Kelas::all()->count(),
            'count_petugas' => User::all()->count(),
        ];
        return view('backend.pages.dashboard', compact('data'));
    }
    public function profile()
    {
        $data = User::with('level')->find(Auth::guard('web')->user()->id);
        return view('backend.pages.profile', compact('data'));
    }
    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::guard('web')->user()->id);
        $user->name = $request->name;
        if ($user->save()) {
            session()->flash('message', 'Profile Berhasil diedit');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Profile gagal diedit');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.profile');
    }
    public function changePassword()
    {
        return view('backend.pages.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required|min:6',
            'password_baru' => 'required|required_with:password_konfirmasi|same:password_konfirmasi|min:6',
            'password_konfirmasi' => 'required'
        ]);
        $user = User::find(Auth::guard('web')->user()->id);
        if (!Hash::check($request->password_lama, $user->password)) {
            session()->flash('message_type', 'danger');
            session()->flash('message', 'Password Lama tidak sesuai!');
        } else {
            $user->password = Hash::make($request->password_baru);
            if ($user->save()) {
                session()->flash('message_type', 'success');
                session()->flash('message', 'Password berhasil diupdate!');
            } else {
                session()->flash('message_type', 'danger');
                session()->flash('message', 'Password gagal diupdate!');
            }
        }
        return redirect()->back();
    }
}
