<?php

namespace App\Http\Controllers\AdminKota;

use App\Models\Opd;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpdController extends Controller
{
    public function index(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $search = $request->input('search'); // Data pencarian
        $query = Opd::select('opds.*', 'master_tahun.tahun', 'sub_opds.nama_sub_opd')
                ->leftjoin('master_tahun', 'master_tahun.id', '=', 'opds.tahun_id')
                ->leftJoin('sub_opds', 'sub_opds.id', '=', 'opds.subopd_id')
                ->where('opds.tahun_id', session()->get('tahun_id_session'))
                ->orderBy('opds.nama_opd', 'ASC');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('opds.nama_opd', 'like', "%$search%");
            });
        }
        $datas = $query->paginate($pagination)->appends(['search' => $search]);
        return view('admin-kota.master.master-opd',compact('datas','pagination','search'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'kode_opd' => 'required',
            'nama_opd' => 'required',
        ]);

        Opd::create([
            'kode_opd' => $request->kode_opd,
            'subopd_id' => $request->subopd_id,
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
            'nama_opd' => 'required',
        ]);
        
        $opd->update([
            'kode_opd' => $request->kode_opd,
            'subopd_id' => $request->subopd_id,
            'nama_opd' => $request->nama_opd,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
