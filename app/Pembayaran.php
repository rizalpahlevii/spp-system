<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pembayaran extends Model
{
    use SoftDeletes;
    protected $table = 'pembayaran';
    protected $fillable = ['petugas_id', 'siswa_id', 'tgl_bayar', 'bulan_bayar', 'tahun_bayar', 'spp_id', 'jumlah_bayar'];
    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }
    public function spp()
    {
        return $this->belongsTo(Spp::class, 'spp_is', 'id');
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
