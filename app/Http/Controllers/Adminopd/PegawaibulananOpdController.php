<?php

namespace App\Http\Controllers\Adminopd;

use App\Models\Opd;
use App\Models\Tahun;
use App\Models\Rupiah;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaibulananOpdController extends Controller
{

    public function index(Request $request)
    {
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }
        $pagination = $request->input('recordsPerPage', 10);
        $search = $request->input('search');
        // $filter = $request->input('filter');
        $page = $request->input('page', 1);
        $total_tpp = 0;
        $individual_tpp = [];
        $rupiah3 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'pagu_apbd')->first();
        $rupiah4 = Rupiah::where('tahun_id', $tahun_id)->where('flag', 'belanja_pegawai')->first();
        $query = Pegawai::data();
        
        // if (Auth::user()->role_id == 2 && Auth::user()->username == 'sekda') {
        //     $query = Pegawai::data()->where('pegawais.opd_id', '35')->whereNull(Auth::user()->kode_sub_opd);
        // } elseif (Auth::user()->role_id == 2 && Auth::user()->opd == 'guru'){
        //     $query = Pegawai::data()->where('pegawais.sts_pegawai', 'GURU');
        // } elseif (Auth::user()->role_id == 6 && Auth::user()->opd == 'bagian') {
        //     $query = Pegawai::data()->whereNull('sub_opds.kode_sub_opd', Auth::user()->kode_sub_opd);
        // } else {
        //     $query = Pegawai::data()->where('opds.kode_opd', Auth::user()->kode_opd);
        // }

        if (Auth::user()->role_id == 2 && Auth::user()->opd == 'guru'){
            $query = Pegawai::data()->where('pegawais.sts_pegawai', 'GURU');
        } else {
            $query = Pegawai::data()->where('opds.kode_sub_opd', Auth::user()->kode_sub_opd);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pegawais.nip', 'like', "%$search%")
                    ->orWhere('pegawais.nama_pegawai', 'like', "%$search%")
                    ->orWhere('opds.nama_opd', 'like', "%$search%")
                    ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$search.'%');
            });
        }
        $datas = $query->paginate($pagination, ['*'], 'page', $page);

        $total_tpp = 0;
        
        foreach ($datas as $pegawai) {
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

            dd($indeks);
            // Rest of your calculation remains the same
            $bk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'beban_kerja')->value('jumlah') ?? 0);
            $pk = (float)(Rupiah::where('tahun_id', $tahun_id)->where('flag', 'prestasi_kerja')->value('jumlah') ?? 0);
            $bulan_bk = (float)$pegawai->bulan_bk;
            $bulan_pk = (float)$pegawai->bulan_pk;

            // Hitung total_tpp untuk pegawai saat ini
            $tpp_pegawai = (($nilai_jabatan * $indeks * $bk) * $bulan_bk) + (($nilai_jabatan * $indeks * $pk) * $bulan_pk);

        
            if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan'){
                $tpp_pegawai *= 0.85; // 85% adjustment
            } elseif ($pegawai->sts_koor == 'Koordinator Bukan Hasil Penyetaraan') {
                $tpp_pegawai *= 0.85; // 100% adjustment
            } elseif ($pegawai->sts_koor == 'Subkoordinator Hasil Penyetaraan') {
                $tpp_pegawai *= 1.00; // 100% adjustment
            } elseif ($pegawai->sts_koor == 'Koordinator Hasil Penyetaraan') {
                $tpp_pegawai *= 1.00; // 100% adjustment
            }

            // Tambahkan nilai total_tpp pegawai ke total_tpp
            $total_tpp = $tpp_pegawai;

            // Store total_tpp for each employee in the array
            $individual_tpp[$pegawai->id] = $total_tpp;

            $total_tpp = 0;
        }
        
        return view('admin-opd.laporan.tpp-pegawai', compact('datas', 'search','pagination','individual_tpp'));
    }

    public function putsession(Request $request)
    {
        session()->forget('tahun_id_session');
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

    public function lock()
    {
        $opd = Opd::where('kode_sub_opd', Auth::user()->kode_sub_opd)->where('tahun_id', session()->get('tahun_id_session'));

        $opd->update([
            'lock' => 1,
        ]);

        if ($opd) {
            session()->put('statusLock', 'Data berhasil dikunci');
        }

        return redirect()->back();
    }
}
