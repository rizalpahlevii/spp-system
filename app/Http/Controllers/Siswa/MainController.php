<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Siswa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = "siswa.pages.";
    }
    public function dashboard()
    {
        return view($this->path . 'dashboard');
    }
    public function profile()
    {
        $data = Siswa::with('kelas.master_kelas')->find(Auth::guard('siswa')->user()->id);
        return view('siswa.pages.profile', compact('data'));
    }
    public function updateProfile(Request $request)
    {
        $user = Siswa::find(Auth::guard('siswa')->user()->id);
        $user->name = $request->name;
        $user->no_telp = $request->no_telp;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->alamat = $request->alamat;
        if ($user->save()) {
            session()->flash('message', 'Profile Berhasil diedit');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Profile gagal diedit');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('siswa.profile');
    }
    public function changePassword()
    {
        return view('siswa.pages.change-password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required|min:6',
            'password_baru' => 'required|required_with:password_konfirmasi|same:password_konfirmasi|min:6',
            'password_konfirmasi' => 'required'
        ]);
        $user = Siswa::find(Auth::guard('web')->user()->id);
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
