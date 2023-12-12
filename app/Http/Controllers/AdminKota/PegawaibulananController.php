<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Opd;
use App\Models\Tpp;
use App\Models\Tahun;
use App\Models\Pegbul;
use App\Models\Rupiah;
use App\Models\Pegawai;
use App\Models\Catatan_opd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PegawaibulananController extends Controller
{

    public function penjabaran(Request $request)
    {
        $opd_first = Opd::where('opds.tahun_id', session()->get('tahun_id_session'))->take(1)->value('id');
        $opd_id = $request->opd_id ?? $opd_first;
        $datas = Tpp::penjabaran($opd_id);

        $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
        $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
        $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
        $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();

        return view('admin-kota.laporan.tpp-penjabaran', compact('datas', 'opd_id', 'tpp_guru_sertifikasi', 'tpp_guru_belum_sertifikasi', 'tpp_pengawas_sekolah', 'tpp_kepala_sekolah'));
    }

    public function penjabaran_excel(Request $request)
    {
        $opd_first = Opd::where('opds.tahun_id', session()->get('tahun_id_session'))->take(1)->value('id');
        $opd_id = $request->opd ?? $opd_first;
        $datas = Tpp::penjabaran($opd_id);
        $datetime = date('Y-m-d H_i_s');

        $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
        $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
        $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
        $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();

        return view('admin-kota.laporan.tpp-penjabaran-excel', compact('datas', 'opd_id', 'datetime', 'tpp_guru_sertifikasi', 'tpp_guru_belum_sertifikasi', 'tpp_pengawas_sekolah', 'tpp_kepala_sekolah'));
    }
    
    public function pensiun(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $search = $request->input('search'); // Data pencarian
        $filteropd = $request->input('filteropd'); // Data filter
        $query = Pegawai::data()->where('sts_pegawai','PENSIUN');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pegawais.nip', 'like', "%$search%")
                    ->orWhere('pegawais.nama_pegawai', 'like', "%$search%");
            });
        }

         // Menambahkan kondisi where untuk filter jika ada
        if ($filteropd) {
            $query->where('pegawais.opd_id', $filteropd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }

        // Memanggil metode data() pada model Pegawai
        $datas = $query->paginate($pagination);

        return view('admin-kota.master.data-pensiun', compact('datas', 'pagination', 'search','filteropd'));
    }

    // public function tppperson(Request $request)
    // {
    //     $tahun_id = 0;

    //     try {
    //         $tahun_id = session()->get('tahun_id_session');
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //     }

    //     $pagination = $request->input('recordsPerPage', 10);
    //     $search = $request->input('search'); // Data pencarian
    //     $filteropd = $request->input('filteropd'); // Data filter
    //     $filtersubopd = $request->input('filtersubopd'); // Data filter
    //     $query = Pegawai::data();

    //     if ($search) {
    //         $query->where(function ($q) use ($search) {
    //             $q->where('pegawais.nip', 'like', "%$search%")
    //                 ->orWhere('pegawais.nama_pegawai', 'like', "%$search%")
    //                 ->orWhere('opds.nama_opd', 'like', "%$search%");
    //         });
    //     }

    //      // Menambahkan kondisi where untuk filter jika ada
    //     if ($filteropd) {
    //         $query->where('pegawais.opd_id', $filteropd);
    //         // Tambahkan kondisi filter untuk kolom lainnya
    //     }
    //     if ($filtersubopd) {
    //         $query->where('pegawais.subopd_id',$filtersubopd);
    //         // Tambahkan kondisi filter untuk kolom lainnya
    //     }

    //     // Memanggil metode data() pada model Pegawai
    //     $datas = $query->paginate($pagination);

    //     $opds=Opd::all();
        
    //     $rumus_bk_tahunan = [];
    //     $rumus_bk_bulanan = [];
    //     $rumus_pk_tahunan = [];
    //     $rumus_pk_bulanan = [];
    //     $rumus_total_tpp_bulanan = [];
    //     $rumus_total_tpp_tahunan = [];
    //     $rumus_bk_tahunan_total = 0;
    //     $rumus_bk_bulanan_total = 0;
    //     $rumus_pk_tahunan_total = 0;
    //     $rumus_pk_bulanan_total = 0;
    //     $rumus_total_tpp_bulanan_total = 0;
    //     $rumus_total_tpp_tahunan_total = 0;
        
    //     foreach ($query as $pegawai) {
    //         if ($pegawai->subkoor == "Subkoor") {
    //             if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
    //                 $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_non_penyetaraan;
    //             } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
    //                 $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_penyetaraan;
    //             }
    //         } elseif ($pegawai->subkoor == "Koor") {
    //             if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
    //                 $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_non_penyetaraan;
    //             } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
    //                 $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_penyetaraan;
    //             }
    //         } else {
    //             $nilai_jabatan = (float) $pegawai->nilai_jabatan;
    //         }
        
    //         // Determine the appropriate indeks
    //         if ($pegawai->subkoor == "Subkoor") {
    //             if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
    //                 $indeks = (float) $pegawai->indeks_subkoor_non_penyetaraan;
    //             } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
    //                 $indeks = (float) $pegawai->indeks_subkoor_penyetaraan;
    //             }
    //         } elseif ($pegawai->subkoor == "Koor") {
    //             if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
    //                 $indeks = (float) $pegawai->indeks_koor_non_penyetaraan;
    //             } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
    //                 $indeks = (float) $pegawai->indeks_koor_penyetaraan;
    //             }
    //         } else {
    //             $indeks = (float) $pegawai->indeks;
    //         }

    //         // Rest of your calculation remains the same
    //         $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
    //         $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0);
    //         $bulan_bk = (float)($pegawai->bulan_bk ?? 0);
    //         $bulan_pk = (float)($pegawai->bulan_pk ?? 0);

    //         $rumus_bk_tahunan = $nilai_jabatan * $indeks *$bk * $bulan_bk;
    //         $rumus_bk_bulanan = $nilai_jabatan * $indeks *$bk;
    //         $rumus_pk_tahunan = $nilai_jabatan * $indeks *$pk * $bulan_pk;
    //         $rumus_pk_bulanan = $nilai_jabatan * $indeks *$pk;
    //         $rumus_total_tpp_bulanan = $rumus_bk_bulanan + $rumus_bk_bulanan;
    //         $rumus_total_tpp_tahunan = $rumus_bk_tahunan + $rumus_pk_tahunan;

    //         $rumus_bk_tahunan_total += $rumus_bk_tahunan;
    //         $rumus_bk_bulanan_total += $rumus_bk_bulanan;
    //         $rumus_pk_tahunan_total += $rumus_pk_tahunan;
    //         $rumus_pk_bulanan_total += $rumus_pk_bulanan;
    //         $rumus_total_tpp_bulanan_total += $rumus_total_tpp_bulanan;
    //         $rumus_total_tpp_tahunan_total += $rumus_total_tpp_tahunan;
    //     }
        
    //     return view('admin-kota.laporan.tpp-pegawai', compact([
    //         'datas',
    //         'opds',
    //         'search',
    //         'filteropd',
    //         'filtersubopd',
    //         'pagination',
    //         'rumus_bk_tahunan',
    //         'rumus_pk_tahunan',
    //         'rumus_bk_bulanan',
    //         'rumus_pk_bulanan',
    //         'rumus_total_tpp_bulanan',
    //         'rumus_total_tpp_tahunan',
    //     ]))->with('i', 0);
        
    // }

    public function tppperson(Request $request)
    {
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }

        $pagination = $request->input('recordsPerPage', 10);
        $search = $request->input('search'); // Data pencarian
        $filteropd = $request->input('filteropd'); // Data filter
        $filtersubopd = $request->input('filtersubopd'); // Data filter
        $query = Pegawai::data();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pegawais.nip', 'like', "%$search%")
                    ->orWhere('pegawais.nama_pegawai', 'like', "%$search%")
                    ->orWhere('opds.nama_opd', 'like', "%$search%");
            });
        }

         // Menambahkan kondisi where untuk filter jika ada
        if ($filteropd) {
            $query->where('pegawais.opd_id', $filteropd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }
        if ($filtersubopd) {
            $query->where('pegawais.subopd_id',$filtersubopd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }

        // Memanggil metode data() pada model Pegawai
        $datas = $query->paginate($pagination);

        $opds=Opd::all();
        

        return view('admin-kota.laporan.tpp-pegawai', compact([
                    'datas',
                    'opds',
                    'search',
                    'filteropd',
                    'filtersubopd',
                    'pagination',
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
        $pegawais = Pegawai::data()->get();
        $opds = Opd::where('opds.tahun_id', $tahun_id)->get();
        // Inisialisasi variabel untuk total pegawai dan total tpp

        return view('admin-kota.laporan.tpp-total', compact('opds','pegawais'))
            ->with('i', ($request->input('page', 1) - 1));
    }      

    public function anggaran(Request $request)
    {
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }

        $rupiah3 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'pagu_apbd')->first();
        $rupiah4 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'belanja_pegawai')->first();
        $rupiah5 = Rupiah::where('tahun_id', $tahun_id)->where('flag','pagu_rapbd')->first();
        $jumlah_pegawai = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('pegawais.sts_pegawai', '!=' ,'PENSIUN')->count();
        $jumlah_guru_sertifikasi = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','guru')->where('sertifikasi_guru','Sudah Sertifikasi')->count();
        $jumlah_guru_belum_sertifikasi = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','guru')->where('sertifikasi_guru','Belum Sertifikasi')->count();
        $jumlah_pengawas_sekolah = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','PENGAWAS SEKOLAH')->count();
        $jumlah_kepala_sekolah = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','KEPALA SEKOLAH')->count();
        $jumlah_pensiun = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('pegawais.sts_pegawai','PENSIUN')->count();
        $rs = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','rs')->count();
        $pppk = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','pppk')->count();
        $catatans = Catatan_opd::proses()->paginate(10);
        $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
        $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
        $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
        $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();
        $total_tpp = 0;
        $tpp_bapenda= 0;
        $total_tpp_guru_sertifikasi = 0;
        $total_tpp_guru_belum_sertifikasi = 0;
        $total_tpp_pengawas_sekolah = 0;
        $total_tpp_kepala_sekolah = 0;    
        $total_all_tpp = 0;
        $pegawais = Pegawai::data()
        ->where('pegawais.tahun_id', $tahun_id)
        ->whereIn('sts_pegawai', ['PNS', 'CPNS', 'PPPK', 'RS', 'PENSIUN'])
        ->where('pegawais.opd_id', '!=', 5)
        ->get();
        $bapenda = Pegawai::data()
        ->where('pegawais.tahun_id', $tahun_id)
        ->whereIn('sts_pegawai', ['PNS', 'CPNS', 'PPPK', 'RS', 'PENSIUN'])
        ->where('pegawais.opd_id', '=', 5)
        ->get();
        $guru_sertifikasi = Pegawai::data()
            ->where('sts_pegawai', 'GURU')
            ->where('sertifikasi_guru', 'sudah sertifikasi')
            ->get();

        $guru_belum_sertifikasi = Pegawai::data()
            ->where('sts_pegawai', 'GURU')
            ->where('sertifikasi_guru', 'belum sertifikasi')
            ->get();

        $pengawas_sekolah = Pegawai::data()
            ->where('sts_pegawai', 'PENGAWAS SEKOLAH')
            ->get();

        $kepala_sekolah = Pegawai::data()
            ->where('sts_pegawai', 'KEPALA SEKOLAH')
            ->get();

        foreach ($bapenda as $data){
            $nilai_jabatan = 0;
            $indeks = 0;
            if ($data->subkoor == "Subkoor") {
                $nilai_jabatan = ($data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                    ? (float) $data->nilai_jabatan_subkor_non_penyetaraan
                    : (float) $data->nilai_jabatan_subkor_penyetaraan;

                $indeks = ($data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                    ? (float) $data->indeks_subkor_non_penyetaraan
                    : (float) $data->indeks_subkor_penyetaraan;
            } elseif ($data->subkoor == "Koor") {
                $nilai_jabatan = ($data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                    ? (float) $data->nilai_jabatan_koor_non_penyetaraan
                    : (float) $data->nilai_jabatan_koor_penyetaraan;

                $indeks = ($data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                    ? (float) $data->indeks_koor_non_penyetaraan
                    : (float) $data->indeks_koor_penyetaraan;
            } else {
                $nilai_jabatan = (float) $data->nilai_jabatan;
                $indeks = (float) $data->indeks;
            }

            // Rest of your calculation remains the same
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
            $bulan_bk = (float)($data->bulan_bk ?? 0);
            // $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
            // $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
            // $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
            // $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();
    
        
            // Tambahkan nilai total_tpp data ke total_tpp
            $tpp_data = (($nilai_jabatan * $indeks * $bk) * $bulan_bk) + 0 ;
            if ($data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan' && $data->sts_koor == 'Koordinator Bukan Hasil Penyetaraan') {
                $tpp_data *= 0.85; // 85% adjustment
            } else {
                $tpp_data *= 1.00; // 100% adjustment
            }
            
            // $total_tpp += $tpp_data;   
            $tpp_bapenda += $tpp_data;
        }
        
        foreach ($guru_sertifikasi as $data){
            $tpp_pegawai = $tpp_guru_sertifikasi * 12;
            $total_tpp_guru_sertifikasi += $tpp_pegawai;
        }
        foreach ($guru_belum_sertifikasi as $data){
            $tpp_pegawai = $tpp_guru_belum_sertifikasi * 12;
            $total_tpp_guru_belum_sertifikasi += $tpp_pegawai;
        }
        foreach ($pengawas_sekolah as $data){
            $tpp_pegawai = $tpp_pengawas_sekolah * 12;
            $total_tpp_pengawas_sekolah += $tpp_pegawai;
        }
        foreach ($kepala_sekolah as $data){
            $tpp_pegawai = $tpp_kepala_sekolah * 12;
            $total_tpp_kepala_sekolah += $tpp_pegawai;
        }

        foreach ($pegawais as $pegawai) {
            $nilai_jabatan = 0;
            $indeks = 0;
            if ($pegawai->subkoor == "Subkoor") {
                $nilai_jabatan = ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                    ? (float) $pegawai->nilai_jabatan_subkor_non_penyetaraan
                    : (float) $pegawai->nilai_jabatan_subkor_penyetaraan;

                $indeks = ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                    ? (float) $pegawai->indeks_subkor_non_penyetaraan
                    : (float) $pegawai->indeks_subkor_penyetaraan;
            } elseif ($pegawai->subkoor == "Koor") {
                $nilai_jabatan = ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                    ? (float) $pegawai->nilai_jabatan_koor_non_penyetaraan
                    : (float) $pegawai->nilai_jabatan_koor_penyetaraan;

                $indeks = ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                    ? (float) $pegawai->indeks_koor_non_penyetaraan
                    : (float) $pegawai->indeks_koor_penyetaraan;
            } else {
                $nilai_jabatan = (float) $pegawai->nilai_jabatan;
                $indeks = (float) $pegawai->indeks;
            }

            // Rest of your calculation remains the same
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
            $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0);
            $bulan_bk = (float)($pegawai->bulan_bk ?? 0);
            $bulan_pk = (float)($pegawai->bulan_pk ?? 0);
            // $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
            // $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
            // $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
            // $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();
    
        
            // Tambahkan nilai total_tpp pegawai ke total_tpp
            $tpp_pegawai = (($nilai_jabatan * $indeks * $bk) * $bulan_bk) + (($nilai_jabatan * $indeks * $pk) * $bulan_pk);
            if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan' && $pegawai->sts_koor == 'Koordinator Bukan Hasil Penyetaraan') {
                $tpp_pegawai *= 0.85; // 85% adjustment
            } else {
                $tpp_pegawai *= 1.00; // 100% adjustment
            }
            
            // $total_tpp += $tpp_pegawai;   
            $total_tpp += $tpp_pegawai;
        }

        $total_all_tpp = $tpp_bapenda + $total_tpp + $total_tpp_kepala_sekolah + $total_tpp_pengawas_sekolah + $total_tpp_guru_belum_sertifikasi + $total_tpp_guru_sertifikasi;
        return view('admin-kota.laporan.anggaran', compact([
            'total_tpp_guru_sertifikasi',
            'total_tpp_guru_belum_sertifikasi',
            'total_tpp_pengawas_sekolah',
            'total_tpp_kepala_sekolah',
            'jumlah_pegawai', 
            'rupiah3', 
            'rupiah4', 
            'rupiah5',
            'jumlah_guru_sertifikasi', 
            'jumlah_guru_belum_sertifikasi', 
            'jumlah_kepala_sekolah', 
            'jumlah_pengawas_sekolah', 
            'rs', 
            'pppk', 
            'catatans', 
            'total_tpp',
            'jumlah_pensiun',
            'pegawais',
            'total_all_tpp',
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
