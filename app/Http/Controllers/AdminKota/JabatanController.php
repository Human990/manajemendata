<?php

namespace App\Http\Controllers\AdminKota;

use App\Models\Jabatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        $tahunid = session()->get('tahun_id_session');
        $pencarian = $request->pencarian;

        if (!empty($request->pencarian)) {
            $datas= Jabatan::pencarian($pencarian)->paginate(10);
        }else {
            $datas= Jabatan::daftar()->paginate(10);
        }

        return view('admin-kota.master.master-jabatan',compact('datas', 'pencarian'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nama_jabatan' => 'required',
            'nilai_jabatan' => 'required',
            'tunjab' => 'required',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'nilai_jabatan' => $request->nilai_jabatan,
            'tunjab' => $request->tunjab,
            'indeks_id' => $request->indeks_id,
            'tahun_id' => session()->get('tahun_id_session'),
            'indeks_subkor_penyetaraan_id' => $request->indeks_subkor_penyetaraan_id,
            'indeks_subkor_non_penyetaraan_id' => $request->indeks_subkor_non_penyetaraan_id,
            'nilai_jabatan_subkor_penyetaraan' => $request->nilai_jabatan_subkor_penyetaraan,
            'nilai_jabatan_subkor_non_penyetaraan' => $request->nilai_jabatan_subkor_non_penyetaraan,
            'prosentase_penerimaan_murni' => $request->prosentase_penerimaan_murni,
            'prosentase_penerimaan_subkor_penyetaraan' => $request->prosentase_penerimaan_subkor_penyetaraan,
            'prosentase_penerimaan_subkor_non_penyetaraan' => $request->prosentase_penerimaan_subkor_non_penyetaraan,
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $this->validate($request, 
        [
            'nama_jabatan' => 'required',
            'nilai_jabatan' => 'required',
            'tunjab' => 'required',
        ]);
        
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'nilai_jabatan' => $request->nilai_jabatan,
            'tunjab' => $request->tunjab,
            'indeks_id' => $request->indeks_id,
            'indeks_subkor_penyetaraan_id' => $request->indeks_subkor_penyetaraan_id,
            'indeks_subkor_non_penyetaraan_id' => $request->indeks_subkor_non_penyetaraan_id,
            'nilai_jabatan_subkor_penyetaraan' => $request->nilai_jabatan_subkor_penyetaraan,
            'nilai_jabatan_subkor_non_penyetaraan' => $request->nilai_jabatan_subkor_non_penyetaraan,
            'prosentase_penerimaan_murni' => $request->prosentase_penerimaan_murni,
            'prosentase_penerimaan_subkor_penyetaraan' => $request->prosentase_penerimaan_subkor_penyetaraan,
            'prosentase_penerimaan_subkor_non_penyetaraan' => $request->prosentase_penerimaan_subkor_non_penyetaraan,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
