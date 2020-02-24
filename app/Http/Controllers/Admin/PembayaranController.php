<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Pembayaran;
use App\Tahun_ajaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    protected $path;
    public function __construct()
    {
        $this->path = "backend.pages.";
    }
    public function index()
    {
        $tahun_ajaran = Tahun_ajaran::all();
        $kelas = Kelas::all();
        if (isset($_GET['kelas']) || isset($_GET['ta'])) {
            $param_kelas = $_GET['kelas'];
            if ($_GET['kelas'] == "all") {
                $pembayaran = Pembayaran::with('siswa', 'petugas', 'spp', 'tahun_ajaran', 'tahun_ajaran.tahun_ajaran_setting');
            } else {
                $pembayaran = Pembayaran::whereHas('siswa', function ($query) use ($param_kelas) {
                    $query->where('kelas_id', $param_kelas);
                })->with('petugas', 'spp', 'siswa.kelas', 'tahun_ajaran', 'tahun_ajaran.tahun_ajaran_setting');
            }

            $ta = $_GET['ta'];
            if ($_GET['ta'] != "all") {
                $pembayaran = $pembayaran->where('tahun_ajaran_id', $ta);
            }
        } else {
            $pembayaran = Pembayaran::with('siswa', 'petugas', 'spp', 'tahun_ajaran', 'tahun_ajaran.tahun_ajaran_setting');
        }
        $pembayaran = $pembayaran->get();
        return view($this->path . 'pembayaran.index', compact('pembayaran', 'kelas', 'tahun_ajaran'));
    }
}
