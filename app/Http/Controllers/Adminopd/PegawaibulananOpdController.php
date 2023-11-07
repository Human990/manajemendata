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
}
