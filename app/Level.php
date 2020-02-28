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
}
