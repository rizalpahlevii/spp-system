<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Level;
use App\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = "backend.pages.";
    }
    public function index()
    {
        $userInfo = Auth::guard('web')->user();
        $level = Level::all();
        $users = User::with('level')->whereNotIn('id', [$userInfo->id])->get();
        return view($this->path . 'petugas.index', compact('users', 'level'));
    }
    public function create()
    {
        $level = Level::all();
        return view($this->path . 'petugas.create', compact('level'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users|min:5',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required|required_with:password|same:password',
            'level' => 'required'
        ]);
        $petugas = new User();
        $petugas->name = $request->name;
        $petugas->email = $request->email;
        $petugas->username = $request->username;
        $petugas->password = Hash::make($request->password);
        $petugas->level_id = $request->level;
        if ($petugas->save()) {
            session()->flash('message', 'Data Berhasil dihapus');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal dihapus');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.petugas_index');
    }
    public function show($id)
    {
        $petugas = User::find($id);
        $level = Level::all();
        return view($this->path . 'petugas.edit', compact('petugas', 'level'));
    }
    public function update(Request $request, $id)
    {
        $petugas = User::find($id);
        if ($request->email == $petugas->email or $request->username == $petugas->username) {
            $request->validate([
                'name' => 'required|min:5',
                'level' => 'required'
            ]);
        } else {
            $request->validate([
                'name' => 'required|min:5',
                'email' => 'required|unique:users|min:5',
                'username' => 'required|unique:users|min:5',
                'level' => 'required'
            ]);
        }
        try {
            $petugas->name = $request->name;
            $petugas->email = $request->email;
            $petugas->username = $request->username;
            $petugas->level_id = $request->level;
            if ($petugas->save()) {
                session()->flash('message', 'Data Berhasil diedit');
                session()->flash('message_type', 'success');
            } else {
                session()->flash('message', 'Data gagal diedit');
                session()->flash('message_type', 'danger');
            }
        } catch (QueryException $e) {
            $request->session()->flash('message', $e->getMessage());
            session()->flash('message_type', 'danger');
            return redirect()->route('admin.petugas_index');
        }
        return redirect()->route('admin.petugas_index');
    }
    public function delete($id)
    {
        $petugas = User::find($id);
        if ($petugas->delete()) {
            session()->flash('message', 'Data Berhasil dihapus');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal dihapus');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.petugas_index');
    }
}
