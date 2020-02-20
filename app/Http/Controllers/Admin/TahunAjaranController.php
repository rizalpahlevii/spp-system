<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Tahun_ajaran;
use App\Tahun_ajaran_setting;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    protected $path = 'admin.pages.';
    public function index()
    {
        $tahun_ajaran = Tahun_ajaran::with('tahun_ajaran_setting')->get();
        return view($this->path . 'tahun_ajaran.index', compact('tahun_ajaran'));
    }
    public function store(Request $request)
    {
        $ta = new Tahun_ajaran();
        $ta->tahun_ajaran_awal = $request->tahun_awal;
        $ta->tahun_ajaran_akhir = $request->tahun_akhir;
        $ta->concat_tahun = $request->tahun_awal . ' S.D ' . $request->tahun_akhir;
        if ($ta->save()) {
            session()->flash('message', 'Data Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.ta_index');
    }
    public function show($id)
    {
        return response()->json(Tahun_ajaran::find($id));
    }
    public function update(Request $request)
    {
        $ta = Tahun_ajaran::find($request->id);
        $ta->tahun_ajaran_awal = $request->tahun_awal;
        $ta->tahun_ajaran_akhir = $request->tahun_akhir;
        $ta->concat_tahun = $request->tahun_awal . ' S.D ' . $request->tahun_akhir;
        if ($ta->save()) {
            session()->flash('message', 'Data Berhasil diedit');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal diedit');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.ta_index');
    }
    public function destroy($id)
    {
        $ta = Tahun_ajaran::with('tahun_ajaran_setting')->find($id);
        if ($ta->tahun_ajaran_setting == null) {
            if ($ta->delete()) {
                session()->flash('message', 'Data Berhasil dihapus');
                session()->flash('message_type', 'success');
            } else {
                session()->flash('message', 'Data gagal dihapus');
                session()->flash('message_type', 'danger');
            }
        } else {
            session()->flash('message', 'Data gagal dihapus');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.ta_index');
    }
    public function setting($id)
    {
        $tahun_ajaran_setting = Tahun_ajaran_setting::where('tahun_ajaran_id', $id)->first();
        if ($tahun_ajaran_setting = null) {
            return redirect()->back();
        }
        $tahun_ajaran = Tahun_ajaran::find($id);
        return view($this->path . 'tahun_ajaran.setting', compact('tahun_ajaran'));
    }
    public function saveSetting(Request $request, $tahun_ajaran_id)
    {
        $this->validate($request, [
            'bulan_ke1' => 'required',
            'bulan_ke2' => 'required',
            'bulan_ke3' => 'required',
            'bulan_ke4' => 'required',
            'bulan_ke5' => 'required',
            'bulan_ke6' => 'required',
            'bulan_ke7' => 'required',
            'bulan_ke8' => 'required',
            'bulan_ke9' => 'required',
            'bulan_ke10' => 'required',
            'bulan_ke11' => 'required',
            'bulan_ke12' => 'required',
        ]);

        $data = new Tahun_ajaran_setting();
        $data->tahun_ajaran_id = $tahun_ajaran_id;
        $data->bulan1 = $request->bulan_ke1;
        $data->bulan2 = $request->bulan_ke2;
        $data->bulan3 = $request->bulan_ke3;
        $data->bulan4 = $request->bulan_ke4;
        $data->bulan5 = $request->bulan_ke5;
        $data->bulan6 = $request->bulan_ke6;
        $data->bulan7 = $request->bulan_ke7;
        $data->bulan8 = $request->bulan_ke8;
        $data->bulan9 = $request->bulan_ke9;
        $data->bulan10 = $request->bulan_ke10;
        $data->bulan11 = $request->bulan_ke11;
        $data->bulan12 = $request->bulan_ke12;
        if ($data->save()) {
            session()->flash('message', 'Pengaturan Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Pengatura gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.ta_index');
    }
    public function viewSetting($tahun_ajaran_id)
    {
        $tahun_ajaran = Tahun_ajaran::with('tahun_ajaran_setting')->where('id', $tahun_ajaran_id)->firstOrFail();
        return view($this->path . 'tahun_ajaran.viewSetting', compact('tahun_ajaran'));
    }
    public function editSetting($id)
    {
        $tahun_ajaran = Tahun_ajaran::with('tahun_ajaran_setting')->where('id', $id)->first();
        if ($tahun_ajaran->tahun_ajaran_setting->is_permanent == "yes") {
            session()->flash('message_type', 'danger');
            return redirect()->back()->with('message', 'Setting sudah permanent');
        }
        return view($this->path . 'tahun_ajaran.setting-edit', compact('tahun_ajaran'));
    }
    public function updateSetting(Request $request, $id)
    {
        $setting = Tahun_ajaran_setting::find($id);
        $setting->bulan1 = $request->bulan_ke1;
        $setting->bulan2 = $request->bulan_ke2;
        $setting->bulan3 = $request->bulan_ke3;
        $setting->bulan4 = $request->bulan_ke4;
        $setting->bulan5 = $request->bulan_ke5;
        $setting->bulan6 = $request->bulan_ke6;
        $setting->bulan7 = $request->bulan_ke7;
        $setting->bulan8 = $request->bulan_ke8;
        $setting->bulan9 = $request->bulan_ke9;
        $setting->bulan10 = $request->bulan_ke10;
        $setting->bulan11 = $request->bulan_ke11;
        $setting->bulan12 = $request->bulan_ke12;
        if ($request->has('submit_permanent')) {
            $setting->is_permanent = "yes";
        }
        if ($setting->save()) {
            session()->flash('message', 'Pengaturan Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Pengatura gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.ta_index');
    }
}
