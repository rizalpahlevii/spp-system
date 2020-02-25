<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kelas extends Model
{

    use SoftDeletes;
    protected $table = 'kelas';
    protected $fillable = ['nama_kelas', 'kompetensi_keahlian', 'tahun_ajaran_id', 'master_kelas_id'];
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id', 'id');
    }
    public function tahun_ajaran()
    {
        return $this->belongsTo(Tahun_ajaran::class, 'tahun_ajaran_id', 'id');
    }
    public function master_kelas()
    {
        return $this->belongsTo(Master_kelas::class, 'master_kelas_id', 'id');
    }
}
