<?php

namespace App\Http\Controllers\Admin;

use App\Kelas;
use App\Spp;
use App\Siswa;
use App\Http\Controllers\Controller;
use App\Master_kelas;
use App\Pembayaran;
use App\Tahun_ajaran_setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class SiswaController extends Controller
{
    protected $path = 'backend.pages.';
    public function index()
    {
        $kelas = Kelas::all();
        if (isset($_GET['kelas'])) {
            if ($_GET['kelas'] == "all") {
                $siswa = Siswa::with('spp', 'kelas')->get();
            } else {
                $siswa = Siswa::with('spp', 'kelas')->where('kelas_id', $_GET['kelas'])->get();
            }
        } else {
            $siswa = Siswa::with('spp', 'kelas')->get();
        }
        return view($this->path . 'siswa.index', compact('siswa', 'kelas'));
    }
    public function create()
    {
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view($this->path . 'siswa.create', compact('kelas', 'spp'));
    }
    public function show($id)
    {
        $siswa = Siswa::with('spp', 'kelas')->where('id', $id)->first();
        $kelas = Kelas::all();
        $spp = Spp::all();
        return view($this->path . 'siswa.edit', compact('siswa', 'kelas', 'spp'));
    }
    public function store(Request $request)
    {
        if ($request->has('fromKelasRoute')) {
            $request->validate([
                'name' => 'required|min:6',
                'nis' => 'required|min:8|unique:siswa',
                'nisn' => 'required|min:10|unique:siswa',
                'spp' => 'required',
                'alamat' => 'required|min:15',
                'no_telp' => 'required|min:10',
                'jenis_kelamin' => 'required'
            ]);
        } else {
            $request->validate([
                'name' => 'required|min:6',
                'nis' => 'required|min:8|unique:siswa',
                'nisn' => 'required|min:10|unique:siswa',
                'kelas' => 'required',
                'spp' => 'required',
                'alamat' => 'required|min:15',
                'no_telp' => 'required|min:10',
                'jenis_kelamin' => 'required'

            ]);
        }
        $siswa = new Siswa();
        $siswa->nisn = $request->nisn;
        $siswa->name = $request->name;
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        if ($request->has('fromKelasRoute')) {
            $siswa->kelas_id = $request->fromKelasRoute;
        } else {
            $siswa->kelas_id = $request->kelas;
        }
        $siswa->spp_id = $request->spp;
        $siswa->password = Hash::make('wikrama');
        if ($siswa->save()) {
            session()->flash('message', 'Data Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        if ($request->has('fromKelasRoute')) {
            return redirect()->route('admin.kelas_siswa', $request->fromKelasRoute);
        }
        return redirect()->route('admin.siswa_index');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:6',
            'nis' => 'required|min:8',
            'kelas' => 'required',
            'spp' => 'required',
            'alamat' => 'required|min:15',
            'no_telp' => 'required|min:10',
            'jenis_kelamin' => 'required'
        ]);
        $siswa = Siswa::find($id);
        $siswa->nisn = $request->nisn;
        $siswa->name = $request->name;
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->alamat = $request->alamat;
        $siswa->no_telp = $request->no_telp;
        $siswa->kelas_id = $request->kelas;
        $siswa->spp_id = $request->spp;
        $siswa->jenis_kelamin = $request->jenis_kelamin;

        if ($siswa->save()) {
            session()->flash('message', 'Data Berhasil diedit');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal diedit');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.siswa_index');
    }
    public function destroy($id)
    {
        $siswa = Siswa::find($id);
        if ($siswa->delete()) {
            session()->flash('message', 'Data Berhasil dihapus');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal dihapus');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.siswa_index');
    }
    public function detail($id)
    {
        $siswa = Siswa::with('spp', 'kelas')->where('id', $id)->first();
        return view($this->path . 'siswa.detail', compact('siswa'));
    }
    public function sppSiswa($id)
    {
        $data = Siswa::with('kelas.master_kelas')->where('id', $id)->firstOrFail();
        $master_kelas = Master_kelas::get();
        if (isset($_GET['mk'])) {
            $master_kelas_param = $_GET['mk'];
            $siswa = Siswa::with(['pembayaran' => function ($query) use ($master_kelas_param) {
                $query->where('master_kelas_id', $master_kelas_param);
                $query->with('spp');
            }])->with('kelas.master_kelas', 'kelas.tahun_ajaran')->where('id', $id)->firstOrFail();
            $master_kelas_view = Master_kelas::find($_GET['mk']);
        } else {
            $siswa = Siswa::with(['pembayaran' => function ($query) use ($data) {
                $query->where('master_kelas_id', $data->kelas->master_kelas_id);
                $query->with('spp');
            }])->with('kelas.master_kelas', 'kelas.tahun_ajaran')->where('id', $id)->firstOrFail();
            $master_kelas_view = Master_kelas::find($data->kelas->master_kelas_id);
        }
        return view($this->path . 'siswa.spp', compact('siswa', 'master_kelas', 'master_kelas_view'));
    }
    public function sppSiswaCreate($id)
    {
        $siswa = Siswa::with('kelas', 'kelas.tahun_ajaran', 'kelas.master_kelas', 'spp')->where('id', $id)->firstOrFail();

        $get_last_spp = Pembayaran::where('siswa_id', $siswa->id)
            ->where('tahun_ajaran_id', $siswa->kelas->tahun_ajaran_id)
            ->where('master_kelas_id', $siswa->kelas->master_kelas_id)
            ->orderBy('id', 'desc')->first();
        $history_spp = Pembayaran::with('spp', 'tahun_ajaran', 'master_kelas', 'siswa.kelas')->where('siswa_id', $siswa->id)->get();

        $tahun_ajaran = $siswa->kelas->tahun_ajaran;
        $setting = Tahun_ajaran_setting::where('tahun_ajaran_id', $tahun_ajaran->id)->first();

        if ($get_last_spp) {
            $getMonthSetting = static::getMonthSetting($tahun_ajaran->id, (int) $get_last_spp->bulan_bayar);
        }

        $data = [
            'data_siswa' => $siswa,
            'data' => [
                'terakhir_spp_value' => $get_last_spp ? $getMonthSetting : 0,
                'terakhir_spp' => $get_last_spp ? convert_bulan($getMonthSetting) : 0,
                'option_bayar' => $get_last_spp ? static::getOptionBayar((int) $get_last_spp->bulan_bayar, $siswa->kelas->tahun_ajaran->id) : static::getOptionBayar(0, $siswa->kelas->tahun_ajaran->id),
                'nominal_spp' => $siswa->spp->nominal,
                'history' => $history_spp,
                'setting' => $setting
            ]
        ];
        return view($this->path . 'siswa.spp_create', compact('siswa', 'data'));
    }
    public function sppSiswaStore(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required',
            'name' => 'required',
            'kelas' => 'required',
            'spp_terakhir' => 'required',
            'bayar_sampai' => 'required',
            'total_bayar' => 'required'
        ]);
        $data = Siswa::with('spp', 'kelas', 'kelas.tahun_ajaran', 'kelas.master_kelas')->where('id', $id)->first();
        $lastSpp = Pembayaran::where('siswa_id', $request->siswa_id)->where('master_kelas_id', $data->kelas->master_kelas_id)->orderBy('bulan_bayar', 'desc')->first();
        $bulan_bayar = $lastSpp ? (int) $lastSpp->bulan_bayar : 0;
        DB::beginTransaction();
        try {
            if ($request->how_many_months > 1) {
                for ($i = 1; $i < $request->how_many_months + 1; $i++) {
                    $pmb = new Pembayaran();
                    $pmb->petugas_id = Auth::guard('web')->user()->id;
                    $pmb->siswa_id = $request->siswa_id;
                    $pmb->tgl_bayar = date('Y-m-d');
                    $pmb->bulan_bayar = $bulan_bayar + $i;
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
                $pmb->bulan_bayar = $bulan_bayar + 1;
                $pmb->tahun_bayar = date('Y');
                $pmb->spp_id = $data->spp_id;
                $pmb->tahun_ajaran_id = $data->kelas->tahun_ajaran->id;
                $pmb->master_kelas_id = $data->kelas->master_kelas_id;
                $pmb->jumlah_bayar = $data->spp->nominal;
                $pmb->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('message', 'Gagal Meyimpan Transaksi');
            session()->flash('message_type', 'danger');
        }
        session()->flash('message', 'Berhasil menyimpan SPP siswa : ' . $data->name . ' selama ' . $request->how_many_months . ' bulan');
        session()->flash('message_type', 'success');
        return redirect()->route('admin.siswa_index');
    }
    private function viewSetting($tahun_ajaran_setting, $pembayaran)
    {
        $array = [];
        $setting = $tahun_ajaran_setting->toArray();
        $count = $pembayaran->count();
        foreach ($pembayaran as $key => $row) {
            $key++;
            $array[] = ['key' => $key, 'value_name' => getMonthSetting($setting['tahun_ajaran_id'], $setting['bulan' . $key]), 'checked' => true];
            if ($key == $count) {
                for ($i = count($array) + 1; $i <= 12; $i++) {
                    $array[] = ['key' => $i, 'value_name' => getMonthSetting($setting['tahun_ajaran_id'], $setting['bulan' . $i]), 'checked' => false];
                }
            }
        }
        return $array;
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
