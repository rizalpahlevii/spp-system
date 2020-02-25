<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Pembayaran;
use App\Siswa;
use App\Tahun_ajaran;
use App\Tahun_ajaran_setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $pembayaran = $pembayaran->paginate(15);
        return view($this->path . 'pembayaran.index', compact('pembayaran', 'kelas', 'tahun_ajaran'));
    }
    private static function getMinLengthNIS()
    {
        $nis = Siswa::select('nis')->get();
        if ($nis->count()) {
            $arr = [];
            foreach ($nis as $key => $row) {
                $arr[] = strlen($row->nis);
            }
            $length_nis = min($arr);
        } else {
            $length_nis = 1;
        }
        return $length_nis;
    }
    public function create()
    {
        $length_nis = static::getMinLengthNIS();
        return view($this->path . 'pembayaran.create', compact('length_nis'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'kelas' => 'required',
            'spp_terakhir' => 'required',
            'bayar_sampai' => 'required',
            'total_bayar' => 'required'
        ]);
        $data = Siswa::with('spp', 'kelas', 'kelas.tahun_ajaran', 'kelas.master_kelas')->where('id', $request->siswa_id)->first();
        if ($request->how_many_months > 1) {
            for ($i = 1; $i < $request->how_many_months + 1; $i++) {
                $pmb = new Pembayaran();
                $pmb->petugas_id = Auth::guard('web')->user()->id;
                $pmb->siswa_id = $request->siswa_id;
                $pmb->tgl_bayar = date('Y-m-d');
                $pmb->bulan_bayar = $request->terakhir_bayar_value + $i;
                $pmb->tahun_bayar = date('Y');
                $pmb->spp_id = $data->spp_id;
                $pmb->tahun_ajaran_id = $data->kelas->tahun_ajaran->id;
                $pmb->jumlah_bayar = $data->spp->nominal;
                $pmb->master_kelas_id = $data->kelas->master_kelas_id;
                $pmb->save();
            }
        } else {
            $pmb = new Pembayaran();
            $pmb->petugas_id = Auth::guard('web')->user()->id;
            $pmb->siswa_id = $request->siswa_id;
            $pmb->tgl_bayar = date('Y-m-d');
            $pmb->bulan_bayar = $request->terakhir_bayar_value + 1;
            $pmb->tahun_bayar = date('Y');
            $pmb->spp_id = $data->spp_id;
            $pmb->tahun_ajaran_id = $data->kelas->tahun_ajaran->id;
            $pmb->master_kelas_id = $data->kelas->master_kelas_id;
            $pmb->jumlah_bayar = $data->spp->nominal;
            $pmb->save();
        }
        session()->flash('message', 'Berhasil menyimpan SPP siswa:' . $data->name . ' selama ' . $request->how_many_months . ' bulan');
        session()->flash('message_type', 'success');
        return redirect()->route('admin.pembayaran_index');
    }
    public function getSiswa($nis)
    {
        $siswa = Siswa::with('kelas', 'kelas.tahun_ajaran', 'kelas.master_kelas', 'spp')->where('nis', $nis)->first();

        $get_last_spp = Pembayaran::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $siswa->kelas->tahun_ajaran_id)
            ->where('master_kelas_id', $siswa->kelas->master_kelas_id)
            ->orderBy('bulan_bayar', 'desc')->first();
        $tahun_ajaran = $siswa->kelas->tahun_ajaran;
        $getMonthSetting = static::getMonthSetting($tahun_ajaran->id, (int) $get_last_spp->bulan_bayar);


        if ($get_last_spp) {
            $response = [
                'data_siswa' => $siswa,
                'data' => [
                    'terakhir_spp_value' => $getMonthSetting,
                    'terakhir_spp' => convert_bulan($getMonthSetting),
                    'option_bayar' => static::getOptionBayar((int) $get_last_spp->bulan_bayar, $siswa->kelas->tahun_ajaran->id),
                    'nominal_spp' => $siswa->spp->nominal
                ]
            ];
        } else {
            $response = [
                'data_siswa' => $siswa,
                'data' => [
                    'terakhir_spp_value' => 0,
                    'terakhir_spp' => 0,
                    'option_bayar' => static::getOptionBayar(0, $siswa->kelas->tahun_ajaran->id),
                    'nominal_spp' => $siswa->spp->nominal
                ]
            ];
        }

        return response()->json($response, 200);
    }
    private static function getOptionBayar($spp_terakhir, $tahun_ajaran_id)
    {
        $setting = Tahun_ajaran_setting::where('tahun_ajaran_id', $tahun_ajaran_id)->first();
        $arr = [];
        $value_setting = [
            ['id' => 1, 'value' => $setting->bulan1],
            ['id' => 2, 'value' => $setting->bulan2],
            ['id' => 3, 'value' => $setting->bulan3],
            ['id' => 4, 'value' => $setting->bulan4],
            ['id' => 5, 'value' => $setting->bulan5],
            ['id' => 6, 'value' => $setting->bulan6],
            ['id' => 7, 'value' => $setting->bulan7],
            ['id' => 8, 'value' => $setting->bulan8],
            ['id' => 9, 'value' => $setting->bulan9],
            ['id' => 10, 'value' => $setting->bulan10],
            ['id' => 11, 'value' => $setting->bulan11],
            ['id' => 12, 'value' => $setting->bulan12]
        ];
        if ($spp_terakhir != 0) {
            $value_setting2 = $value_setting;
            foreach ($value_setting as $key => $row) {
                if ($row['id'] > $spp_terakhir) {
                    $arr[] = ['id' => $row['value'], 'name' => convert_bulan($row['value'])];
                }
            }
        } else {
            foreach ($value_setting as $key => $row) {
                $arr[] = ['id' => $row['value'], 'name' => convert_bulan($row['value'])];
            }
        }
        return $arr;
    }
    private static function getMonthSetting($tahun_ajaran_id, $value_id)
    {
        $setting = Tahun_ajaran_setting::where('tahun_ajaran_id', $tahun_ajaran_id)->first();
        switch ($value_id) {
            case 1:
                $ret = $setting->bulan1;
                break;
            case 2:
                $ret = $setting->bulan2;
                break;
            case 3:
                $ret = $setting->bulan3;
                break;
            case 4:
                $ret = $setting->bulan4;
                break;
            case 5:
                $ret = $setting->bulan5;
                break;
            case 6:
                $ret = $setting->bulan6;
                break;
            case 7:
                $ret = $setting->bulan7;
                break;
            case 8:
                $ret = $setting->bulan8;
                break;
            case 9:
                $ret = $setting->bulan9;
                break;
            case 10:
                $ret = $setting->bulan10;
                break;
            case 11:
                $ret = $setting->bulan11;
                break;
            case 12:
                $ret = $setting->bulan12;
                break;

            default:
                $ret = 1;
                break;
        }
        return $ret;
    }
}
