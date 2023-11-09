<?php

namespace App\Http\Controllers\AdminKota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Jabatan;
use App\Models\Rupiah;
use App\Models\Indeks;
use App\Models\Opd;
use DB;

class CopyController extends Controller
{
    public function copy(Request $request)
    {
        $tahun_asal = $request->tahun_asal;
        $tahun_tujuan = $request->tahun_tujuan;

        // $tahun_asal = 1;
        // $tahun_tujuan = 2;

        if ($tahun_asal == $tahun_tujuan) {
            session()->put('statusError', 'Tidak bisa copy ke tahun sama');
        }else {
            DB::table('indeks')->where('tahun_id', $tahun_tujuan)->delete();
            DB::table('jabatans')->where('tahun_id', $tahun_tujuan)->delete();
            DB::table('master_rupiah')->where('tahun_id', $tahun_tujuan)->delete();
            DB::table('opds')->where('tahun_id', $tahun_tujuan)->delete();
            DB::table('pegawais')->where('tahun_id', $tahun_tujuan)->delete();

            $opds = Opd::where('tahun_id', $tahun_asal)->get();
            $rupiahs = Rupiah::where('tahun_id', $tahun_asal)->get();
            $indeks = Indeks::where('tahun_id', $tahun_asal)->get();
            $jabatans = Jabatan::where('tahun_id', $tahun_asal)->get();
            $pegawais = Pegawai::where('tahun_id', $tahun_asal)->get();

            foreach ($opds as $opd) {
                $opdCopy = Opd::create([
                    'kode_opd' => $opd->kode_opd,
                    'kode_sub_opd' => $opd->kode_sub_opd,
                    'nama_opd' => $opd->nama_opd,
                    'tahun_id' => $tahun_tujuan,
                    'asal_id' => $opd->id,
                ]);
            }

            foreach ($rupiahs as $rupiah) {
                $rupiahCopy = Rupiah::create([
                    'nama' => $rupiah->nama,
                    'jumlah' => $rupiah->jumlah,
                    'tahun_id' => $tahun_tujuan,
                    'asal_id' => $rupiah->id,
                    'flag' => $rupiah->flag,
                ]);
            }

            foreach ($indeks as $indek) {
                $indekCopy = Indeks::create([
                    'jenis_jabatan' => $indek->jenis_jabatan,
                    'kelas_jabatan' => $indek->kelas_jabatan,
                    'indeks' => $indek->indeks,
                    'jenis_jabatan_id' => $indek->jenis_jabatan_id,
                    'tahun_id' => $tahun_tujuan,
                    'asal_id' => $indek->kode_indeks,
                ]);
            }

            foreach ($jabatans as $jabatan) {
                $indeks_id = null;
                $indeks_subkor_penyetaraan_id = null;
                $indeks_subkor_non_penyetaraan_id = null;
                $indeks_koor_penyetaraan_id = null;
                $indeks_koor_non_penyetaraan_id = null;
                
                $indeks_id = Indeks::where('tahun_id', $tahun_tujuan)->where('asal_id', $jabatan->indeks_id)->value('kode_indeks');
                $indeks_subkor_penyetaraan_id = Indeks::where('tahun_id', $tahun_tujuan)->where('asal_id', $jabatan->indeks_subkor_penyetaraan_id)->value('kode_indeks');
                $indeks_subkor_non_penyetaraan_id = Indeks::where('tahun_id', $tahun_tujuan)->where('asal_id', $jabatan->indeks_subkor_non_penyetaraan_id)->value('kode_indeks');
                $indeks_koor_penyetaraan_id = Indeks::where('tahun_id', $tahun_tujuan)->where('asal_id', $jabatan->indeks_koor_penyetaraan_id)->value('kode_indeks');
                $indeks_koor_non_penyetaraan_id = Indeks::where('tahun_id', $tahun_tujuan)->where('asal_id', $jabatan->indeks_koor_non_penyetaraan_id)->value('kode_indeks');

                $jabatanCopy = Jabatan::create([
                    'nama_jabatan' => $jabatan->nama_jabatan,
                    'nilai_jabatan' => $jabatan->nilai_jabatan,
                    'tunjab' => $jabatan->tunjab,
                    'indeks_id' => $indeks_id,
                    'tahun_id' => $tahun_tujuan,
                    'asal_id' => $jabatan->kode_jabatanlama,

                    'indeks_subkor_penyetaraan_id' => $indeks_subkor_penyetaraan_id,
                    'indeks_subkor_non_penyetaraan_id' => $indeks_subkor_non_penyetaraan_id,
                    'nilai_jabatan_subkor_penyetaraan' => $jabatan->nilai_jabatan_subkor_penyetaraan,
                    'nilai_jabatan_subkor_non_penyetaraan' => $jabatan->nilai_jabatan_subkor_non_penyetaraan,
                    'prosentase_penerimaan_murni' => $jabatan->prosentase_penerimaan_murni,
                    'prosentase_penerimaan_subkor_penyetaraan' => $jabatan->prosentase_penerimaan_subkor_penyetaraan,
                    'prosentase_penerimaan_subkor_non_penyetaraan' => $jabatan->prosentase_penerimaan_subkor_non_penyetaraan,
                    
                    'indeks_koor_penyetaraan_id' => $indeks_koor_penyetaraan_id,
                    'indeks_koor_non_penyetaraan_id' => $indeks_koor_non_penyetaraan_id,
                    'nilai_jabatan_koor_penyetaraan' => $jabatan->nilai_jabatan_koor_penyetaraan,
                    'nilai_jabatan_koor_non_penyetaraan' => $jabatan->nilai_jabatan_koor_non_penyetaraan,
                    'prosentase_penerimaan_koor_penyetaraan' => $jabatan->prosentase_penerimaan_koor_penyetaraan,
                    'prosentase_penerimaan_koor_non_penyetaraan' => $jabatan->prosentase_penerimaan_koor_non_penyetaraan,
                    'tunjab_subkor' => $jabatan->tunjab_subkor,
                    'tunjab_koor' => $jabatan->tunjab_koor,
                ]);
            }

            foreach ($pegawais as $pegawai) {
                $opd_id = null;
                $jabatan_id = null;
                $opd_id = Opd::where('tahun_id', $tahun_tujuan)->where('asal_id', $pegawai->opd_id)->value('id');
                $jabatan_id = Jabatan::where('tahun_id', $tahun_tujuan)->where('asal_id', $pegawai->kode_jabatanlama)->value('kode_jabatanlama');

                $pegawaiCopy = Pegawai::create([
                    'opd_id' => $opd_id,
                    'nip' => $pegawai->nip,
                    'nama_pegawai' => $pegawai->nama_pegawai,
                    'sts_pegawai' => $pegawai->sts_pegawai,
                    'kode_jabatanlama' => $jabatan_id ?? 0,
                    'sts_jabatan' => $pegawai->sts_jabatan,
                    'golongan' => $pegawai->golongan,
                    'pangkat' => $pegawai->pangkat,
                    'eselon' => $pegawai->eselon,
                    'pensiun' => $pegawai->pensiun,
                    'bulan_bk' => $pegawai->bulan_bk,
                    'bulan_pk' => $pegawai->bulan_pk,
                    'tpp' => $pegawai->tpp,
                    'tpp_tambahan' => $pegawai->tpp_tambahan,
                    'subkoor' => $pegawai->subkoor,
                    'nama_subkoor' => $pegawai->nama_subkoor,
                    'sts_subkoor' => $pegawai->sts_subkoor,
                    'jft' => '',
                    'tahun_id' => $tahun_tujuan,
                ]);
            }

            session()->put('statusCopy', 'Data berhasil dicopy');
        }

        return redirect()->back();
    }
}
