<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Opd;
use App\Models\Pegbul;
use App\Models\Tahun;
use App\Models\Rupiah;
use App\Models\Pegawai;
use App\Models\Catatan_opd;
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
        $jumlah_pegawai_definitif = $jumlah_pegawai - $jumlah_plt - $jumlah_plh - $jumlah_pengganti_sementara;
        
        return view('admin-kota.laporan.tpp-pegawai', compact([
            'datas', 'jumlah_pegawai', 'rupiah1', 'rupiah2', 'opds',
            'jumlah_pppk', 'jumlah_plt', 'jumlah_plh', 'jumlah_pengganti_sementara',
            'jumlah_pegawai_definitif'
        ]))->with('i', 0);
    }

    public function totaltpp(Request $request)
    {
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }

        // Ambil data pegawai dengan left join jabatan dan indeks
        $pegawais = Pegawai::leftJoin('jabatans', 'pegawais.kode_jabatanlama', '=', 'jabatans.kode_jabatanlama')
                        ->leftJoin('indeks', 'jabatans.indeks_id', '=', 'indeks.kode_indeks')
                        ->select('pegawais.*', 'jabatans.nilai_jabatan', 'indeks.indeks')
                        ->where('pegawais.tahun_id', $tahun_id)
                        ->get();
        $opds = Opd::where('opds.tahun_id', $tahun_id)->get();
        // Inisialisasi variabel untuk total pegawai dan total tpp
        $totalPegawai = 0;
        $totalTpp = 0;
        $totalPegawaiOverall = 0;
        $totalTppOverall = 0;

        // Inisialisasi array untuk menyimpan jumlah pegawai dan tpp per OPD
        $totalPegawaiPerOpd = [];
        $totalTppPerOpd = [];

        // Loop through each pegawai to calculate total pegawai and total tpp per OPD
        foreach ($pegawais as $pegawai) {
            $totalPegawaiOverall += 1; // Hitung jumlah pegawai secara keseluruhan
        
            // Sesuaikan rumus untuk menghitung total TPP per OPD
            $nilaiJabatan = (float)($pegawai->jabatans->nilai_jabatan ?? 0);
            $indeks = (float)($pegawai->jabatans->indeks->indeks ?? 0);
            $totalBulanPenerimaan = (float)($pegawai->total_bulan_penerimaan ?? 0);
        
            // Rumus perhitungan TPP per OPD
            $tppPerOpd = ($nilaiJabatan * $indeks * ($totalBulanPenerimaan + 1) * Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah')) +
                         ($nilaiJabatan * $indeks * $totalBulanPenerimaan * Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah'));
        
            // Tambahkan nilai total TPP per OPD ke variabel totalTppPerOpd
            $opdNama = $pegawai->opds->nama_opd;
            $totalTppPerOpd[$opdNama] = ($totalTppPerOpd[$opdNama] ?? 0) + $tppPerOpd;
        
            // Hitung total tpp secara keseluruhan
            $totalTppOverall += $tppPerOpd;
        
            // Hitung jumlah pegawai per OPD
            $totalPegawaiPerOpd[$opdNama] = ($totalPegawaiPerOpd[$opdNama] ?? 0) + 1;
        }        

        // Hitung total tpp secara keseluruhan
        foreach ($totalTppPerOpd as $tppPerOpd) {
            $totalTppOverall += $tppPerOpd;
        }

        return view('admin-kota.laporan.tpp-total', compact('opds','pegawais', 'totalPegawai', 'totalTpp', 'totalPegawaiOverall', 'totalTppOverall', 'totalPegawaiPerOpd', 'totalTppPerOpd'))
            ->with('i', ($request->input('page', 1) - 1));
    }      

    public function anggaran(Request $request)
    {
        $jumlah_pegawai = Pegawai::count();

        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }

        $rupiah3 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'pagu_apbd')->first();
        $rupiah4 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'belanja_pegawai')->first();
        $jumlahguru = Pegawai::where('sts_pegawai','guru')->count();
        $rs = Pegawai::where('sts_pegawai','rs')->count();
        $pppk = Pegawai::where('sts_pegawai','pppk')->count();
        $catatans = Catatan_opd::proses()->paginate(10);
        
        $total_tpp = 0;
        // Ambil data pegawai dengan left join jabatan dan indeks
        $pegawais = Pegawai::leftJoin('jabatans', 'pegawais.kode_jabatanlama', '=', 'jabatans.kode_jabatanlama')
                        ->leftJoin('indeks', 'jabatans.indeks_id', '=', 'indeks.kode_indeks')
                        ->select('pegawais.*', 'jabatans.nilai_jabatan', 'indeks.indeks')
                        ->where('pegawais.tahun_id', $tahun_id)
                        ->get();
         // Loop through each pegawai to calculate total_tpp
        foreach ($pegawais as $pegawai) {
            $nilai_jabatan = (float) ($pegawai->nilai_jabatan ?? 0);
            $indeks = (float) ($pegawai->indeks ?? 0);
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0); // Sesuaikan dengan ID yang sesuai
            $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0); // Sesuaikan dengan ID yang sesuai
            $total_bulan_penerimaan = (float)($pegawai->total_bulan_penerimaan ?? 0);

            // Hitung total_tpp untuk pegawai saat ini
            $tpp_pegawai = (($nilai_jabatan * $indeks * $bk) * ($total_bulan_penerimaan + 1)) + (($nilai_jabatan * $indeks * $pk) * $total_bulan_penerimaan);

            // Tambahkan nilai total_tpp pegawai ke total_tpp
            $total_tpp += $tpp_pegawai;
        }

        return view('admin-kota.laporan.anggaran', compact([
            'jumlah_pegawai', 
            'rupiah3', 
            'rupiah4', 
            'jumlahguru', 
            'rs', 
            'pppk', 
            'catatans', 
            'total_tpp'
            ]))
        ->with('i', ($request->input('page', 1) - 1));
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
