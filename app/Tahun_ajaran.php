<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahun_ajaran extends Model
{
    protected $table = 'tahun_ajaran';
    protected $fillable = ['tahun_awal', 'tahun_akhir', 'concat_tahun'];
    public function tahun_ajaran_setting()
    {
        return $this->hasOne(Tahun_ajaran_setting::class, 'tahun_ajaran_id', 'id');
    }
}
