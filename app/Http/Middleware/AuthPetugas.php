<?php

namespace App\Http\Middleware;

use App\Role;
use App\User_role;
use Closure;
use Illuminate\Support\Facades\Auth;

class AuthPetugas
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('web')->user();
        $uri = request()->segment(2);
        if ($uri != "role") {
            $role = Role::where('uri', $uri)->first();
            $check = User_role::where('role_id', $role->id)->where('level_id', $user->level_id)->first();
        } else {
            $check = false;
        }

        if (!Auth::guard('web')->check() || !$check) {
            if ($uri != "role") {
                abort(403, 'Unauthorized action.');
            }
        }
        return $next($request);
    }
}
