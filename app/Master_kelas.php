<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Master_kelas extends Model
{
    protected $table = 'master_kelas';
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'mater_kelas_id', 'id');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'master_kelas_id', 'id');
    }
}
