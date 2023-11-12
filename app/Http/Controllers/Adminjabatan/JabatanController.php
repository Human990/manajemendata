<?php

namespace App\Http\Controllers\Adminjabatan;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    public function dashboard()
    {
        return view('admin-jabatan.master.dashboard');
    }

    public function index(Request $request)
    {
        $tahunid = session()->get('tahun_id_session');
        $pencarian = $request->pencarian;
        $pagination = $request->input('recordsPerPage', 10);

        if (!empty($request->pencarian)) {
            $datas= Jabatan::pencarian($pencarian)->paginate($pagination);
        }else {
            $datas= Jabatan::daftar()->paginate($pagination);
        }

        return view('admin-jabatan.master.master-jabatan',compact('datas', 'pencarian','pagination'));
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

            'indeks_koor_penyetaraan_id' => $request->indeks_koor_penyetaraan_id,
            'indeks_koor_non_penyetaraan_id' => $request->indeks_koor_non_penyetaraan_id,
            'nilai_jabatan_koor_penyetaraan' => $request->nilai_jabatan_koor_penyetaraan,
            'nilai_jabatan_koor_non_penyetaraan' => $request->nilai_jabatan_koor_non_penyetaraan,
            'prosentase_penerimaan_koor_penyetaraan' => $request->prosentase_penerimaan_koor_penyetaraan,
            'prosentase_penerimaan_koor_non_penyetaraan' => $request->prosentase_penerimaan_koor_non_penyetaraan,

            'tunjab' => $request->tunjab,
            'tunjab_subkor' => $request->tunjab_subkor,
            'tunjab_koor' => $request->tunjab_koor,
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
            
            'indeks_koor_penyetaraan_id' => $request->indeks_koor_penyetaraan_id,
            'indeks_koor_non_penyetaraan_id' => $request->indeks_koor_non_penyetaraan_id,
            'nilai_jabatan_koor_penyetaraan' => $request->nilai_jabatan_koor_penyetaraan,
            'nilai_jabatan_koor_non_penyetaraan' => $request->nilai_jabatan_koor_non_penyetaraan,
            'prosentase_penerimaan_koor_penyetaraan' => $request->prosentase_penerimaan_koor_penyetaraan,
            'prosentase_penerimaan_koor_non_penyetaraan' => $request->prosentase_penerimaan_koor_non_penyetaraan,

            'tunjab' => $request->tunjab,
            'tunjab_subkor' => $request->tunjab_subkor,
            'tunjab_koor' => $request->tunjab_koor,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
