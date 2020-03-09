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

        $pembayaran = Pembayaran::with('spp', 'tahun_ajaran', 'master_kelas')->where('tahun_ajaran_id', $siswa->kelas->tahun_ajaran_id)->where('master_kelas_id', $siswa->kelas->master_kelas_id)->orderBy('bulan_bayar', 'desc')->get();

        $setting = Tahun_ajaran_setting::where('tahun_ajaran_id', $siswa->kelas->tahun_ajaran_id)->first();

        $ta = $siswa->kelas->tahun_ajaran_id;
        $viewSetting = $this->viewSetting($setting, $pembayaran);
        $limit = $pembayaran->count();
        return view($this->path . 'siswa.spp_create', compact('siswa', 'pembayaran', 'viewSetting', 'limit'));
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
}
