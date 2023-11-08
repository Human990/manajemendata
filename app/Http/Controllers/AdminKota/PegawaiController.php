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

        // $datas = Pegawai::select(
        //     'pegawais.*',
        //     'master_tahun.tahun',
        //     'jabatans.nama_jabatan',
        //     'opds.nama_opd'
        // )
        // ->leftJoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
        // ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
        // ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
        // ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
        // ->when($search, function ($query) use ($search) {
        //     $query->where('nama_pegawai', 'LIKE', '%' . $search . '%')
        //           ->orWhere('nip', 'LIKE', '%' . $search . '%');
        // })
        // ->orderBy('pegawais.id', 'ASC')
        // ->paginate(10);

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
    
    // public function index(Request $request)
    // {
    //     $search = $request->input('search');
    //     $jabatanOptions = Jabatan::all();

    // $datas = Pegbul::select(
    //     'pegawai_bulanan.*',
    //     'master_tahun.tahun',
    //     'jabatans.nama_jabatan'
    // )
    // ->leftJoin('master_tahun', 'master_tahun.id', '=', 'pegawai_bulanan.tahun_id')
    // ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawai_bulanan.kode_jabatanlama')
    // ->where('pegawai_bulanan.tahun_id', session()->get('tahun_id_session'))
    // ->when($search, function ($query) use ($search) {
    //     $query->where('nama_pegawai', 'LIKE', '%' . $search . '%')
    //           ->orWhere('nip', 'LIKE', '%' . $search . '%');
    // })
    // ->orderBy('pegawai_bulanan.id', 'ASC')
    // ->paginate(10);

    // return view('admin-kota.master.data-pegawai', compact('datas', 'search','jabatanOptions'));
    // }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'eselon' => 'required',
            'total_bulan_penerimaan' => 'required',
        ]);

        Pegawai::create([
            // 'nip' => $request->nip,
            // 'nama_pegawai' => $request->nama_pegawai,
            // 'sts_pegawai' => $request->sts_pegawai,
            // 'ukor_eselon2' => $request->ukor_eselon2,
            // 'kode_jabatanlama' => $request->kode_jabatanlama,
            // 'pangkat' => $request->pangkat,
            // 'eselon' => $request->eselon,
            // 'tpp' => $request->tpp,
            // 'sertifikasi_guru' => $request->sertifikasi_guru,
            // 'pa_kpa' => $request->pa_kpa,
            // 'pbj' => $request->pbj,
            // 'jft' => $request->jft,
            // 'subkoor' => $request->subkoor,
            // 'nama_subkoor' => $request->nama_subkoor,
            // 'sts_subkoor' => $request->sts_subkoor,
            // 'atasan_nip' => $request->atasan_nip,
            // 'atasan_nama' => $request->atasan_nama,
            // 'atasannya_atasan_nip' => $request->atasannya_atasan_nip,
            // 'atasannya_atasan_nama' => $request->atasannya_atasan_nama,
            // 'bulan' => $request->bulan,
            // 'tpp_tambahan' => $request->tpp_tambahan,

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
            'golongan' => 'required',
            'eselon' => 'required',
            'total_bulan_penerimaan' => 'required',
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
            'tpp_tambahan' => $request->tpp_tambahan,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
