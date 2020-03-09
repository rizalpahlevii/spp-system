<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Level;
use App\Role;
use App\User_role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    protected $path = "backend.pages.";
    public function index()
    {
        $level = Level::with('user_role.role')->get();
        return view($this->path . 'roles.user.index', compact('level'));
    }
    public function show($id)
    {
        $level = Level::with('user_role')->where('id', $id)->firstOrFail();
        $menu = Role::where('is_active', 'yes')->get();
        return view($this->path . 'roles.user.show', compact('level', 'menu'));
    }
    public function save(Request $request)
    {
        $roleId = $request->menuId;
        $levelId = $request->levelId;
        $data = User_role::where('role_id', $roleId)->where('level_id', $levelId)->first();
        if ($data) {
            $data->delete();
        } else {
            $user_role = new User_role();
            $user_role->role_id = $roleId;
            $user_role->level_id = $levelId;
            $user_role->save();
        }
        return response()->json(true);
    }
}
