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
            $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.tunjab', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.nilai_jabatan_subkor_penyetaraan', 
                                    'jabatans.nilai_jabatan_subkor_non_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_murni', 
                                    'jabatans.prosentase_penerimaan_subkor_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_subkor_non_penyetaraan', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                    'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                    'jenis_jabatans.jenis_jabatan',
                                    'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                    'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan')
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->where('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%')
                            ->orderBy('jabatans.created_at','DESC')
                            ->paginate(10);
        }else {
            $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.tunjab', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.nilai_jabatan_subkor_penyetaraan', 
                                    'jabatans.nilai_jabatan_subkor_non_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_murni', 
                                    'jabatans.prosentase_penerimaan_subkor_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_subkor_non_penyetaraan', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                    'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                    'jenis_jabatans.jenis_jabatan',
                                    'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                    'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan')
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->orderBy('jabatans.created_at','DESC')
                            ->paginate(10);
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
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
