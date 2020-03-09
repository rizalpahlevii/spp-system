<?php


use App\Level;
use App\Role;
use App\User_role;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

if (!function_exists('sidebar')) {
    function sidebar()
    {
        $levelId = auth()->guard('web')->user()->level_id;
        $sidebar = DB::table('user_roles')->leftJoin('roles', 'roles.id', '=', 'user_roles.role_id')->where('level_id', $levelId)->get();
        return $sidebar;
    }
}
