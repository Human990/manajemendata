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
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }
        $search = $request->input('search');

        $filterOpd = '';
        $filterOpd = $request->filterOpd;

        if (!empty($filterOpd)) {
            $datas = Pegawai::filterOpd($filterOpd);
        } elseif (!empty($search)) {
            $datas = Pegawai::pencarian($search);
        } else {
            $datas = Pegawai::data();
        }
        $opds=Opd::all();
        
        // $rumus_bk_tahunan = 0;
        // $rumus_bk_bulanan = 0;
        // $rumus_pk_tahunan = 0;
        // $rumus_bk_bulanan = 0;
        // $rumus_total_tpp_bulanan = 0;
        // $rumus_total_tpp_tahunan = 0;
        $rumus_bk_tahunan_total = 0;
        $rumus_bk_bulanan_total = 0;
        $rumus_pk_tahunan_total = 0;
        $rumus_pk_bulanan_total = 0;
        $rumus_total_tpp_bulanan_total = 0;
        $rumus_total_tpp_tahunan_total = 0;
        
        foreach ($datas as $pegawai) {
            if ($pegawai->subkoor == "Subkoor") {
                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_penyetaraan;
                }
            } elseif ($pegawai->subkoor == "Koor") {
                if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_penyetaraan;
                }
            } else {
                $nilai_jabatan = (float) $pegawai->nilai_jabatan;
            }
        
            // Determine the appropriate indeks
            if ($pegawai->subkoor == "Subkoor") {
                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_subkoor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_subkoor_penyetaraan;
                }
            } elseif ($pegawai->subkoor == "Koor") {
                if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_koor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_koor_penyetaraan;
                }
            } else {
                $indeks = (float) $pegawai->indeks;
            }

            // Rest of your calculation remains the same
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
            $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0);
            $bulan_bk = (float)($pegawai->bulan_bk ?? 0);
            $bulan_pk = (float)($pegawai->bulan_pk ?? 0);

            $rumus_bk_tahunan = $nilai_jabatan * $indeks *$bk * $bulan_bk;
            $rumus_bk_bulanan = $nilai_jabatan * $indeks *$bk;
            $rumus_pk_tahunan = $nilai_jabatan * $indeks *$pk * $bulan_pk;
            $rumus_pk_bulanan = $nilai_jabatan * $indeks *$pk;
            $rumus_total_tpp_bulanan = $rumus_bk_bulanan + $rumus_bk_bulanan;
            $rumus_total_tpp_tahunan = $rumus_bk_tahunan + $rumus_pk_tahunan;

            $rumus_bk_tahunan_total += $rumus_bk_tahunan;
            $rumus_bk_bulanan_total += $rumus_bk_bulanan;
            $rumus_pk_tahunan_total += $rumus_pk_tahunan;
            $rumus_pk_bulanan_total += $rumus_pk_bulanan;
            $rumus_total_tpp_bulanan_total += $rumus_total_tpp_bulanan;
            $rumus_total_tpp_tahunan_total += $rumus_total_tpp_tahunan;
        }
        
        return view('admin-kota.laporan.tpp-pegawai', compact([
            'datas',
            'opds',
            'search',
            'filterOpd',
            'rumus_bk_tahunan',
            'rumus_pk_tahunan',
            'rumus_bk_bulanan',
            'rumus_pk_bulanan',
            'rumus_total_tpp_bulanan',
            'rumus_total_tpp_tahunan',
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
        $pegawais = Pegawai::select('pegawais.id',
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
                                    'pegawais.bulan_bk',
                                    'pegawais.bulan_pk',
                                    'pegawais.pensiun',
                                    'pegawais.subkoor',
                                    'pegawais.nama_subkoor',
                                    'pegawais.sts_subkoor',
                                    'pegawais.golongan','pegawais.tpp',
                                    'jabatans.kode_jabatanlama', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.tunjab', 
                                    'jabatans.nilai_jabatan_subkor_penyetaraan', 
                                    'jabatans.nilai_jabatan_subkor_non_penyetaraan', 
                                    'jabatans.nilai_jabatan_koor_penyetaraan', 
                                    'jabatans.nilai_jabatan_koor_non_penyetaraan', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                    'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                    'indeks_koor_penyetaraan.kelas_jabatan AS kelas_jabatan_koor_penyetaraan', 
                                    'indeks_koor_penyetaraan.indeks AS indeks_koor_penyetaraan', 
                                    'indeks_koor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_koor_non_penyetaraan', 
                                    'indeks_koor_non_penyetaraan.indeks AS indeks_koor_non_penyetaraan', 
                                    'jenis_jabatans.jenis_jabatan',
                                    'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                    'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan',
                                    'jenis_jabatan_koor_penyetaraan.jenis_jabatan AS jenis_koor_penyetaraan',
                                    'jenis_jabatan_koor_non_penyetaraan.jenis_jabatan AS jenis_koor_non_penyetaraan',
                                    'opds.nama_opd'
                                )
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_koor_penyetaraan', 'indeks_koor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_koor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_koor_non_penyetaraan', 'indeks_koor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_koor_non_penyetaraan_id')
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_koor_penyetaraan', 'jenis_jabatan_koor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_koor_non_penyetaraan', 'jenis_jabatan_koor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
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
        
            if ($pegawai->subkoor == "Subkoor") {
                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_penyetaraan;
                }
            } elseif ($pegawai->subkoor == "Koor") {
                if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_penyetaraan;
                }
            } else {
                $nilai_jabatan = (float) $pegawai->nilai_jabatan;
            }
        
            // Determine the appropriate indeks
            if ($pegawai->subkoor == "Subkoor") {
                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_subkoor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_subkoor_penyetaraan;
                }
            } elseif ($pegawai->subkoor == "Koor") {
                if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_koor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_koor_penyetaraan;
                }
            } else {
                $indeks = (float) $pegawai->indeks;
            }

            // Rest of your calculation remains the same
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
            $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0);
            $bulan_bk = (float)($pegawai->bulan_bk ?? 0);
            $bulan_pk = (float)($pegawai->bulan_pk ?? 0);

            // Hitung total_tpp untuk pegawai saat ini
            $tppPerOpd = (($nilai_jabatan * $indeks * $bk) * $bulan_bk) + (($nilai_jabatan * $indeks * $pk) * $bulan_pk);
        
            if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan' && $pegawai->sts_koor == 'Koordinator Bukan Hasil Penyetaraan') {
                $tppPerOpd *= 0.85; // 85% adjustment
            } else {
                $tppPerOpd *= 1.00; // 100% adjustment
            }

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
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }

        $rupiah3 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'pagu_apbd')->first();
        $rupiah4 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'belanja_pegawai')->first();
        $jumlah_pegawai = Pegawai::where('pegawais.tahun_id', $tahun_id)->count();
        $jumlahguru = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','guru')->count();
        $rs = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','rs')->count();
        $pppk = Pegawai::where('pegawais.tahun_id', $tahun_id)->where('sts_pegawai','pppk')->count();
        $catatans = Catatan_opd::proses()->paginate(10);
        $total_tpp = 0;
        $pegawais = Pegawai::select('pegawais.id',
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
                                    'pegawais.bulan_bk',
                                    'pegawais.bulan_pk',
                                    'pegawais.pensiun',
                                    'pegawais.subkoor',
                                    'pegawais.nama_subkoor',
                                    'pegawais.sts_subkoor',
                                    'pegawais.golongan','pegawais.tpp',
                                    'jabatans.kode_jabatanlama', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.tunjab', 
                                    'jabatans.nilai_jabatan_subkor_penyetaraan', 
                                    'jabatans.nilai_jabatan_subkor_non_penyetaraan', 
                                    'jabatans.nilai_jabatan_koor_penyetaraan', 
                                    'jabatans.nilai_jabatan_koor_non_penyetaraan', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                    'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                    'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                    'indeks_koor_penyetaraan.kelas_jabatan AS kelas_jabatan_koor_penyetaraan', 
                                    'indeks_koor_penyetaraan.indeks AS indeks_koor_penyetaraan', 
                                    'indeks_koor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_koor_non_penyetaraan', 
                                    'indeks_koor_non_penyetaraan.indeks AS indeks_koor_non_penyetaraan', 
                                    'jenis_jabatans.jenis_jabatan',
                                    'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                    'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan',
                                    'jenis_jabatan_koor_penyetaraan.jenis_jabatan AS jenis_koor_penyetaraan',
                                    'jenis_jabatan_koor_non_penyetaraan.jenis_jabatan AS jenis_koor_non_penyetaraan',
                                    'opds.nama_opd'
                                )
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_koor_penyetaraan', 'indeks_koor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_koor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_koor_non_penyetaraan', 'indeks_koor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_koor_non_penyetaraan_id')
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_koor_penyetaraan', 'jenis_jabatan_koor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_koor_non_penyetaraan', 'jenis_jabatan_koor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
                        ->where('pegawais.tahun_id', $tahun_id)
                        ->get();

        foreach ($pegawais as $pegawai) {
            // nilai_jabatan
            if ($pegawai->subkoor == "Subkoor") {
                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_subkoor_penyetaraan;
                }
            } elseif ($pegawai->subkoor == "Koor") {
                if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
                    $nilai_jabatan = (float) $pegawai->nilai_jabatan_koor_penyetaraan;
                }
            } else {
                $nilai_jabatan = (float) $pegawai->nilai_jabatan;
            }
        
            // Determine the appropriate indeks
            if ($pegawai->subkoor == "Subkoor") {
                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_subkoor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Subkoordinator Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_subkoor_penyetaraan;
                }
            } elseif ($pegawai->subkoor == "Koor") {
                if ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_koor_non_penyetaraan;
                } elseif ($pegawai->sts_subkoor == 'Koordinator Hasil Penyetaraan') {
                    $indeks = (float) $pegawai->indeks_koor_penyetaraan;
                }
            } else {
                $indeks = (float) $pegawai->indeks;
            }

            // Rest of your calculation remains the same
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
            $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0);
            $bulan_bk = (float)($pegawai->bulan_bk ?? 0);
            $bulan_pk = (float)($pegawai->bulan_pk ?? 0);

            // Hitung total_tpp untuk pegawai saat ini
            $tpp_pegawai = (($nilai_jabatan * $indeks * $bk) * $bulan_bk) + (($nilai_jabatan * $indeks * $pk) * $bulan_pk);

            if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan' && $pegawai->sts_koor == 'Koordinator Bukan Hasil Penyetaraan') {
                $tpp_pegawai *= 0.85; // 85% adjustment
            } else {
                $tpp_pegawai *= 1.00; // 100% adjustment
            }
        
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
            'total_tpp',
            'pegawais'
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
