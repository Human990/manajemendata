<?php

namespace App\Http\Controllers\Adminopd;

use App\Models\Tahun;
use App\Models\Pegbul;
use App\Models\Rupiah;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Jabatanbaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaibulananOpdController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $datas = Pegawai::select(
                'pegawais.id',
                'pegawais.nip', 
                'pegawais.nama_pegawai', 
                'pegawais.sts_pegawai', 
                'pegawais.sts_jabatan', 
                'pegawais.pangkat', 
                'pegawais.eselon', 
                'pegawais.pensiun', 
                'pegawais.tpp_tambahan', 
                'pegawais.jumlah_pemangku', 
                'pegawais.basic_tpp', 
                'pegawais.total_bulan_penerimaan', 
                'pegawais.opd_id', 
                'jabatans.kode_jabatanlama', 
                'jabatans.nama_jabatan', 
                'jabatans.nilai_jabatan', 
                'jabatans.indeks_id', 
                'jabatans.tunjab', 
                'master_tahun.tahun', 
                'indeks.kelas_jabatan', 
                'indeks.indeks', 
                'jenis_jabatans.jenis_jabatan'
            )
            ->leftJoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
            ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
            ->leftJoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
            ->orderBy('pegawais.id', 'ASC')
            ->where('pegawais.opd_id', Auth::user()->opd_id)  // Menyaring data berdasarkan opd dari user yang login
            ->paginate(10);

        return view('admin-opd.laporan.tpp-pegawai', compact('datas', 'search'));
    }

    public function putsession(Request $request)
    {
        session()->forget('tahunid_session');
        session()->forget('tahun_session');

        session()->put('tahun_id_session', $request->tahun_id);
        session()->put('tahun_session', Tahun::where('id', $request->tahun_id)->value('tahun'));

        return redirect()->back();
    }

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

        return redirect()->route('adminopd-pegawai')->with('success','Data Berhasil Disimpan!');
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
