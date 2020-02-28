<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Master_kelas;
use App\Pembayaran;
use App\Siswa;
use App\Spp;
use App\Tahun_ajaran;
use App\Tahun_ajaran_setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HistoryController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = "siswa.pages.";
    }
}
