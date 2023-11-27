<?php

namespace App\Http\Controllers\AdminKota;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class JabatanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $datas = Jabatan::daftar();
            $i = 1;
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function () use (&$i) {
                    return $i++;
                })
                ->addColumn('action', 'admin-kota.master.action.jabatan-action')
                ->make(true);
        }
        $datas = Jabatan::daftar();

        return view('admin-kota.master.master-jabatan',compact('datas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nama_jabatan' => 'required',
            'nilai_jabatan' => 'required',
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
