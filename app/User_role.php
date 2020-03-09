<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_role extends Model
{
    public function role()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }
}
