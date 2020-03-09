<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $guard = 'siswa';
    protected $table = 'siswa';
    protected $fillable = ['nisn', 'nis', 'name', 'password', 'kelas_id', 'alamat', 'no_telp', 'spp_id'];
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_id', 'id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'siswa_id', 'id');
    }
}
