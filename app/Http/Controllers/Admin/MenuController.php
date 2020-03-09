<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $path = "backend.pages.";
    public function index()
    {
        $menus = Role::get();
        return view($this->path . 'roles.menu.index', compact('menus'));
    }
    public function create()
    {
        $url = route('admin.role_menu_store');
        return view($this->path . 'roles.menu.create', compact('url'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:3',
            'icon' => 'required|min:3'
        ]);
        $menu = new Role();
        $menu->title = $request->title;
        $menu->icon = $request->icon;

        if ($request->is_active == "yes") {
            $menu->is_active = $request->is_active;
        } else {
            $menu->is_active = "no";
        }

        if ($menu->save()) {
            session()->flash('message', 'Data Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.role_menu');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|min:3',
            'icon' => 'required|min:3',
        ]);
        $menu = Role::find($id);
        $menu->title = $request->title;
        $menu->icon = $request->icon;
        if ($request->is_active == "yes") {
            $menu->is_active = $request->is_active;
        } else {
            $menu->is_active = "no";
        }

        if ($menu->save()) {
            session()->flash('message', 'Data Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.role_menu');
    }
    public function show($id)
    {
        $menu = Role::find($id);
        $url = route('admin.role_menu_update', $id);
        return view($this->path . 'roles.menu.create', compact('menu', 'url'));
    }
}
