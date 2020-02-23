<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Spp;
use App\Tahun_ajaran;
use Illuminate\Http\Request;

class SppController extends Controller
{
    protected $path = 'backend.pages.';
    public function index()
    {
        $spp = Spp::with('tahun_ajaran')->get();
        $tahun_ajaran = Tahun_ajaran::all();
        return view($this->path . 'spp.index', compact('spp', 'tahun_ajaran'));
    }
    public function store(Request $request)
    {
        $spp = new Spp();
        $spp->tahun_ajaran_id = $request->tahun_ajaran;
        $spp->nominal = $request->nominal;
        if ($spp->save()) {
            session()->flash('message', 'Data Berhasil disimpan');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal disimpan');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.spp_index');
    }
    public function show($id)
    {
        return response()->json(Spp::with('tahun_ajaran')->where('id', $id)->firstOrFail());
    }
    public function update(Request $request)
    {
        $spp = Spp::find($request->id);
        $spp->nominal = $request->nominal;
        $spp->tahun_ajaran_id = $request->tahun_ajaran;
        if ($spp->save()) {
            session()->flash('message', 'Data Berhasil diedit');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal diedit');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.spp_index');
    }
    public function destroy($id)
    {
        $spp = Spp::find($id);
        if ($spp->delete()) {
            session()->flash('message', 'Data Berhasil dihapus');
            session()->flash('message_type', 'success');
        } else {
            session()->flash('message', 'Data gagal dihapus');
            session()->flash('message_type', 'danger');
        }
        return redirect()->route('admin.spp_index');
    }
}
