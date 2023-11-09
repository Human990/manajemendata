<?php

namespace App\Http\Controllers\AdminKota;

// use App\Models\Pegbul;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $filter = '';
        $filter = $request->filter;

        if (!empty($filter)) {
            $datas = Pegawai::filter($filter);
        }else {
            $datas = Pegawai::data();
        }

        if (!empty($search)) {
            $datas = Pegawai::pencarian($search);
        }else {
            $datas = Pegawai::data();
        }

        return view('admin-kota.master.data-pegawai', compact('datas','search', 'filter'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'pangkat' => 'required',
            'eselon' => 'required',
        ]);

        Pegawai::create([

            'opd_id' => $request->opd_id,
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'sts_pegawai' => $request->sts_pegawai,
            'kode_jabatanlama' => $request->kode_jabatanlama,
            'sts_jabatan' => $request->sts_jabatan,
            'golongan' => $request->golongan,
            'pangkat' => $request->pangkat,
            'eselon' => $request->eselon,
            'pensiun' => $request->pensiun,
            'bulan_bk' => $request->bulan_bk,
            'bulan_pk' => $request->bulan_pk,
            'tpp' => $request->tpp,
            'tpp_tambahan' => $request->tpp_tambahan,
            'subkoor' => $request->subkoor,
            'nama_subkoor' => $request->nama_subkoor,
            'sts_subkoor' => $request->sts_subkoor,
            'jft' => '',
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->route('adminkota-pegawai')->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'pangkat' => 'required',
            'eselon' => 'required',
        ]);
        
        $pegawai->update([
            'opd_id' => $request->opd_id,
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'sts_pegawai' => $request->sts_pegawai,
            'kode_jabatanlama' => $request->kode_jabatanlama,
            'sts_jabatan' => $request->sts_jabatan,
            'golongan' => $request->golongan,
            'pangkat' => $request->pangkat,
            'eselon' => $request->eselon,
            'pensiun' => $request->pensiun,
            'bulan_bk' => $request->bulan_bk,
            'bulan_pk' => $request->bulan_pk,
            'tpp' => $request->tpp,
            // 'tpp' => 'Penerima TPP',
            'tpp_tambahan' => $request->tpp_tambahan,
            'subkoor' => $request->subkoor,
            'nama_subkoor' => $request->nama_subkoor,
            'sts_subkoor' => $request->sts_subkoor,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
