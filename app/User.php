<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'username', 'level'
    ];

    protected $hidden = [
        'password'
    ];
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }
}
