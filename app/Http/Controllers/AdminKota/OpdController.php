<?php

namespace App\Http\Controllers\AdminKota;

use App\Models\Opd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index(Request $request)
    {
        $datas= Opd::select('opds.*', 'master_tahun.tahun')
                     ->leftjoin('master_tahun', 'master_tahun.id', '=', 'opds.tahun_id')
                     ->where('opds.tahun_id', session()->get('tahun_id_session'))
                     ->orderBy('opds.nama_opd','ASC')
                     ->get();

        return view('admin-kota.master.master-opd',compact('datas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'kode_opd' => 'required',
            'kode_sub_opd' => 'required',
            'nama_opd' => 'required',
        ]);

        Opd::create([
            'kode_opd' => $request->kode_opd,
            'kode_sub_opd' => $request->kode_sub_opd,
            'nama_opd' => $request->nama_opd,
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Opd $opd)
    {
        $this->validate($request, 
        [
            'kode_opd' => 'required',
            'kode_sub_opd' => 'required',
            'nama_opd' => 'required',
        ]);
        
        $opd->update([
            'kode_opd' => $request->kode_opd,
            'kode_sub_opd' => $request->kode_sub_opd,
            'nama_opd' => $request->nama_opd,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
