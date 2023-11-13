<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Subopd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubopdController extends Controller
{
    public function index(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $datas= Subopd::select('sub_opds.*', 'master_tahun.tahun','opds.nama_opd')
                     ->leftjoin('master_tahun', 'master_tahun.id', '=', 'sub_opds.tahun_id')
                     ->join('opds','opds.id','=','sub_opds.opd_id')
                     ->where('sub_opds.tahun_id', session()->get('tahun_id_session'))
                     ->orderBy('sub_opds.nama_sub_opd','ASC')
                     ->paginate($pagination);

        return view('admin-kota.master.master-sub-opd',compact('datas','pagination'));
    }

    public function store(Request $request)
    {
        $this->validate($request,
        [
            'kode_sub_opd' => 'required',
            'nama_sub_opd' => 'required',
            'level' => 'required',
            'opd_id' => 'required'
        ]);

        Subopd::create([
            'kode_sub_opd' => $request->kode_sub_opd,
            'nama_sub_opd' => $request->nama_sub_opd,
            'level' => $request->level,
            'tahun_id' => session()->get('tahun_id_session'),
            // 'opd_id' => $request->opd_id,
        ]);
        
        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Subopd $subopd)
    {
        $this->validate($request,
        [
            'kode_sub_opd' => 'required',
            'nama_sub_opd' => 'required',
            'level' => 'required',
            // 'opd_id' => 'required'
        ]);

        $subopd->update([
            'kode_sub_opd' => $request->kode_sub_opd,
            'nama_sub_opd' => $request->nama_sub_opd,
            'level' => $request->level,
            // 'opd_id' => $request->opd_id,
        ]);
        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
