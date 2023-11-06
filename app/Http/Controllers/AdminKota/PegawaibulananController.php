<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Opd;
use App\Models\Pegbul;
use App\Models\Tahun;
use App\Models\Rupiah;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PegawaibulananController extends Controller
{
    public function tppperson(Request $request)
    {
        $opdFilter = $request->input('opd');
        $searchQuery = $request->input('search');
        $rupiah1 = Rupiah::where('id', 1)->first();
        $rupiah2 = Rupiah::where('id', 2)->first();
        $opds = Opd::all();

        $query = Pegawai::select(
            'pegawais.*',
            'master_tahun.tahun',
            'jabatans.nama_jabatan',
            'jabatans.jenis_jabatan',
            'jabatans.kelas_jabatan',
            'jabatans.nilai_jabatan',
            'opds.nama_opd',
            'indeks.indeks as nilai_indeks'
        )
            ->leftJoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
            ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
            ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
            ->leftJoin('indeks', 'jabatans.indeks_id', '=', 'indeks.kode_indeks')
            ->where('pegawais.tahun_id', session()->get('tahun_id_session'));

        // Tambahkan filter berdasarkan OPD jika dipilih
        if ($opdFilter) {
            $query->where('pegawais.opd_id', $opdFilter);
        }

        // Tambahkan kondisi pencarian
        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('pegawais.nip', 'like', '%' . $searchQuery . '%')
                    ->orWhere('pegawais.nama_pegawai', 'like', '%' . $searchQuery . '%');
                // Tambahkan kolom lain yang ingin dicari sesuai kebutuhan
            });
        }

        $datas = $query->orderBy('pegawais.id', 'ASC')->paginate(10);

        // Hitung jumlah pegawai berdasarkan kriteria tertentu dari hasil query yang telah difilter
        $jumlah_pegawai = $datas->total();
        $jumlah_pppk = $datas->where('sts_pegawai', 'PPPK')->count();
        $jumlah_plt = $datas->where('sts_jabatan', 'PLT')->count();
        $jumlah_plh = $datas->where('sts_jabatan', 'PLH')->count();
        $jumlah_pengganti_sementara = $datas->where('sts_jabatan', 'Pengganti Sementara')->count();
        
        return view('admin-kota.laporan.tpp-pegawai', compact([
            'datas', 'jumlah_pegawai', 'rupiah1', 'rupiah2', 'opds',
            'jumlah_pppk', 'jumlah_plt', 'jumlah_plh', 'jumlah_pengganti_sementara'
        ]))->with('i', 0);
    }

    public function totaltpp(Request $request)
    {
        $jumlah_pegawai = Pegawai::count();
        $rupiah1 = Rupiah::where('id',1)->first();
        $rupiah2 = Rupiah::where('id',2)->first();
        $rupiah3 = Rupiah::where('id', 3)->first();
        $rupiah4 = Rupiah::where('id', 4)->first();
        // $pegawai = DB::table('view_tpp')->get(); | menunggu master jabatan dan indeks
        return view('admin-kota.laporan.tpp-total',compact(['jumlah_pegawai','rupiah1','rupiah2','rupiah3','rupiah4']))->with('i',($request->input('page',1)-1));
    }

    public function anggaran(Request $request)
    {
        $jumlah_pegawai = Pegawai::count();
        $rupiah3 = Rupiah::where('id', 3)->first();
        $rupiah4 = Rupiah::where('id', 4)->first();
        // tambahkan rumus untuk total_tpp, belum bisa karena indeks dan jabatan belum fix
        $jumlahguru = Pegawai::where('sts_pegawai','guru')->count();
        $rs = Pegawai::where('sts_pegawai','rs')->count();
        $pppk = Pegawai::where('sts_pegawai','pppk')->count();
        return view('admin-kota.laporan.anggaran',compact(['jumlah_pegawai','rupiah3','rupiah4','jumlahguru','rs','pppk']))->with('i',($request->input('page',1)-1));
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
