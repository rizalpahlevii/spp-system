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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HistoryController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = "siswa.pages.";
    }
    public function index()
    {
        $userInfo = Auth::guard('siswa')->user();
        $data = Siswa::with('kelas.master_kelas')->where('id', $userInfo->id)->firstOrFail();
        $master_kelas = Master_kelas::get();
        if (isset($_GET['kelas'])) {
            $master_kelas_param = $_GET['kelas'];
            if ($_GET['kelas'] != "all") {
                $siswa = Siswa::with(['pembayaran' => function ($query) use ($master_kelas_param) {
                    $query->where('master_kelas_id', $master_kelas_param);
                    $query->with('spp');
                }])->with('kelas.master_kelas')->where('id', $userInfo->id)->firstOrFail();
            } else {
                $siswa = Siswa::with(['pembayaran' => function ($query) use ($master_kelas_param) {
                    $query->with('spp');
                }])->with('kelas.master_kelas')->where('id', $userInfo->id)->firstOrFail();
            }
        } else {
            $siswa = Siswa::with(['pembayaran' => function ($query) use ($data) {
                $query->where('master_kelas_id', $data->kelas->master_kelas_id);
                $query->with('spp');
            }])->with('kelas.master_kelas')->where('id', $userInfo->id)->firstOrFail();
        }
        return view($this->path . 'history.index', compact('siswa', 'master_kelas'));
    }
}
