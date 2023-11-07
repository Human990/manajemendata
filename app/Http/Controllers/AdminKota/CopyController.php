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
                $indeks_id = Indeks::where('tahun_id', $tahun_tujuan)->where('asal_id', $jabatan->indeks_id)->value('kode_indeks');
                $jabatanCopy = Jabatan::create([
                    'nama_jabatan' => $jabatan->nama_jabatan,
                    'nilai_jabatan' => $jabatan->nilai_jabatan,
                    'tunjab' => $jabatan->tunjab,
                    'indeks_id' => $indeks_id,
                    'tahun_id' => $tahun_tujuan,
                    'asal_id' => $jabatan->kode_jabatanlama,
                ]);
            }

            foreach ($pegawais as $pegawai) {
                $opd_id = null;
                $jabatan_id = null;
                $opd_id = Opd::where('tahun_id', $tahun_tujuan)->where('asal_id', $pegawai->opd_id)->value('id');
                $jabatan_id = Jabatan::where('tahun_id', $tahun_tujuan)->where('asal_id', $pegawai->kode_jabatanlama)->value('kode_jabatanlama');

                $pegawaiCopy = Pegawai::create([
                    'nip' => $pegawai->nip,
                    'nama_pegawai' => $pegawai->nama_pegawai,
                    'sts_pegawai' => $pegawai->sts_pegawai,
                    'sts_jabatan' => $pegawai->sts_jabatan,
                    'golongan' => $pegawai->golongan,
                    'pangkat' => $pegawai->pangkat,
                    'eselon' => $pegawai->eselon,
                    'total_bulan_penerimaan' => $pegawai->total_bulan_penerimaan,
                    'tpp' => $pegawai->tpp,
                    'tpp_tambahan' => $pegawai->tpp_tambahan,
                    'jft' => '',
                    'opd_id' => $opd_id,
                    'kode_jabatanlama' => $jabatan_id ?? 0,
                    'tahun_id' => $tahun_tujuan,
                ]);
            }

            session()->put('statusCopy', 'Data berhasil dicopy');
        }

        return redirect()->back();
    }
}
