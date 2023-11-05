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
        $datas = Pegawai::select(
            'pegawais.*',
            'master_tahun.tahun',
            'jabatans.nama_jabatan',
            'opds.nama_opd'
        )
        ->leftJoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
        ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
        ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
        ->when($search, function ($query) use ($search) {
            $query->where('nama_pegawai', 'LIKE', '%' . $search . '%')
                  ->orWhere('nip', 'LIKE', '%' . $search . '%');
        })
        ->orderBy('pegawais.id', 'ASC')
        ->paginate(10);

    return view('admin-kota.master.data-pegawai', compact('datas','search'));
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
            'nip' => 'required|unique:pegawai,nip',
            'nama_pegawai' => 'required',
            'sts_pegawai' => 'required',
            'ukor_eselon2' => 'required',
            'kode_jabatanlama' => 'required',
            'pangkat' => 'required',
            'eselon' => 'required',
            'tpp' => 'required',
            'sertifikasi_guru' => '',
            'pa_kpa' => '',
            'pbj' => '',
            'jft' => 'required',
            'subkoor' => '',
            'nama_subkoor' => '',
            'sts_subkoor' => '',
            'atasan_nip' => '',
            'atasan_nama' => '',
            'atasannya_atasan_nip' => '',
            'atasannya_atasan_nama' => '',
            'bulan' => 'required',
            'tpp_tambahan' => '',
        ]);

        Pegbul::create([
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'sts_pegawai' => $request->sts_pegawai,
            'ukor_eselon2' => $request->ukor_eselon2,
            'kode_jabatanlama' => $request->kode_jabatanlama,
            'pangkat' => $request->pangkat,
            'eselon' => $request->eselon,
            'tpp' => $request->tpp,
            'sertifikasi_guru' => $request->sertifikasi_guru,
            'pa_kpa' => $request->pa_kpa,
            'pbj' => $request->pbj,
            'jft' => $request->jft,
            'subkoor' => $request->subkoor,
            'nama_subkoor' => $request->nama_subkoor,
            'sts_subkoor' => $request->sts_subkoor,
            'atasan_nip' => $request->atasan_nip,
            'atasan_nama' => $request->atasan_nama,
            'atasannya_atasan_nip' => $request->atasannya_atasan_nip,
            'atasannya_atasan_nama' => $request->atasannya_atasan_nama,
            'bulan' => $request->bulan,
            'tpp_tambahan' => $request->tpp_tambahan,
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->route('adminkota-pegawai')->with('success','Data Berhasil Disimpan!');
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
