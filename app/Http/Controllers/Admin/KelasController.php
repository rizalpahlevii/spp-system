<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Kelas;
use App\Siswa;
use App\Spp;
use App\Tahun_ajaran;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    protected $path = 'backend.pages.';
    public function index()
    {
        $kelas = Kelas::with('tahun_ajaran')->get();
        $tahun_ajaran = Tahun_ajaran::has('tahun_ajaran_setting')->get();
        return view($this->path . 'kelas.index', compact('kelas', 'tahun_ajaran'));
    }
    public function createSiswaByKelas($id)
    {
        $spp = Spp::all();
        return view($this->path . 'siswa.create', compact('spp'));
    }
    public function store(Request $request)
    {
        $kelas = new Kelas();
        $kelas->nama_kelas = $request->name;
        $kelas->tahun_ajaran_id = $request->tahun_ajaran;
        $kelas->kompetensi_keahlian = $request->kompetensi_keahlian;
        if ($kelas->save()) {
            session()->flash('message', 'Data Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.kelas_index');
    }
    public function show($id)
    {
        return response()->json(Kelas::with('tahun_ajaran')->where('id', $id)->firstOrFail());
    }
    public function update(Request $request)
    {
        $kelas = Kelas::find($request->id);
        $kelas->nama_kelas = $request->name;
        $kelas->tahun_ajaran_id = $request->tahun_ajaran;
        $kelas->kompetensi_keahlian = $request->kompetensi_keahlian;
        if ($kelas->save()) {
            session()->flash('message', 'Data Berhasil diedit');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal diedit');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.kelas_index');
    }
    public function destroy($id)
    {
        $kelas = Kelas::with('tahun_ajaran')::where('id', $id)->firstOrFail();
        if ($kelas->delete()) {
            session()->flash('message', 'Data Berhasil dihapus');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal dihapus');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.kelas_index');
    }
    public function siswa($kelas_id)
    {
        $data = Kelas::with('siswa', 'tahun_ajaran', 'siswa.spp')->where('id', $kelas_id)->first();
        return view($this->path . 'kelas.siswa', compact('data'));
    }
}
