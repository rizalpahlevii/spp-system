<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    protected $table = 'level';
    protected $fillable = ['nama'];
    public function user()
    {
        return $this->hasMany(User::class, 'level_id', 'id');
    }
    public function user_role()
    {
        return $this->hasMany(User_role::class, 'level_id', 'id');
    }
    // public function role()
    // {
    //     return $this->hasMany(User_role::class, 'level_id', 'id');
    // }
}
