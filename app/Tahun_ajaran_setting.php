<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tahun_ajaran_setting extends Model
{
    protected $table = 'tahun_ajaran_setting';
    protected $fillable = [
        'tahun_ajaran_id',
        'bulan1',
        'bulan2',
        'bulan3',
        'bulan4',
        'bulan5',
        'bulan6',
        'bulan7',
        'bulan8',
        'bulan9',
        'bulan10',
        'bulan11',
        'bulan12',
    ];
    public function tahun_ajaran()
    {
        return $this->belongsTo(Tahun_ajaran::class, 'tahun_ajaran_id', 'id');
    }
}
