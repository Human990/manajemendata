<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Tpp extends Model
{
    use HasFactory;
    protected $table = 'tpp_total';

    public static function penjabaran($opd)
    {
        $tahun = session()->get('tahun_id_session');

        if ($opd == 0) {
            $data = DB::select("
                            SELECT
                                jabatans.kode_jabatanlama,
                                jabatans.nama_jabatan,
                                opds.kode_opd,
                                opds.nama_opd,
                                jenis_jabatans.jenis_jabatan,
                                indeks.kelas_jabatan,
                                indeks.basic_tpp,
                                COUNT(pegawais.id) AS jumlah_pemangku, 
                                indeks.indeks, 
                                jabatans.nilai_jabatan 
                            FROM
                                pegawais
                                LEFT JOIN master_tahun ON master_tahun.id = pegawais.tahun_id
                                LEFT JOIN jabatans ON jabatans.kode_jabatanlama = pegawais.kode_jabatanlama
                                LEFT JOIN indeks ON indeks.kode_indeks = jabatans.indeks_id
                                LEFT JOIN indeks AS indeks_subkor_penyetaraan ON indeks_subkor_penyetaraan.kode_indeks = jabatans.indeks_subkor_penyetaraan_id
                                LEFT JOIN indeks AS indeks_subkor_non_penyetaraan ON indeks_subkor_non_penyetaraan.kode_indeks = jabatans.indeks_subkor_non_penyetaraan_id
                                LEFT JOIN indeks AS indeks_koor_penyetaraan ON indeks_koor_penyetaraan.kode_indeks = jabatans.indeks_koor_penyetaraan_id
                                LEFT JOIN indeks AS indeks_koor_non_penyetaraan ON indeks_koor_non_penyetaraan.kode_indeks = jabatans.indeks_koor_non_penyetaraan_id
                                LEFT JOIN jenis_jabatans ON jenis_jabatans.id = indeks.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_subkor_penyetaraan ON jenis_jabatan_subkor_penyetaraan.id = indeks_subkor_penyetaraan.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan ON jenis_jabatan_subkor_non_penyetaraan.id = indeks_subkor_non_penyetaraan.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_koor_penyetaraan ON jenis_jabatan_koor_penyetaraan.id = indeks_subkor_penyetaraan.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_koor_non_penyetaraan ON jenis_jabatan_koor_non_penyetaraan.id = indeks_subkor_non_penyetaraan.jenis_jabatan_id
                                LEFT JOIN opds ON opds.id = pegawais.opd_id
                                LEFT JOIN sub_opds ON sub_opds.id = pegawais.subopd_id 
                            WHERE
                                pegawais.tahun_id = $tahun 
                            GROUP BY
                                jabatans.kode_jabatanlama,
                                jabatans.nama_jabatan,
                                opds.kode_opd,
                                opds.nama_opd,
                                jenis_jabatans.jenis_jabatan,
                                indeks.kelas_jabatan,
                                indeks.basic_tpp,
                                indeks.indeks, 
                                jabatans.nilai_jabatan 
                            ORDER BY
                                pegawais.id ASC;
                    ");            
        }else {
            $data = DB::select("
                            SELECT
                                jabatans.kode_jabatanlama,
                                jabatans.nama_jabatan,
                                opds.kode_opd,
                                opds.nama_opd,
                                jenis_jabatans.jenis_jabatan,
                                indeks.kelas_jabatan,
                                indeks.basic_tpp,
                                COUNT(pegawais.id) AS jumlah_pemangku, 
                                indeks.indeks, 
                                jabatans.nilai_jabatan 
                            FROM
                                pegawais
                                LEFT JOIN master_tahun ON master_tahun.id = pegawais.tahun_id
                                LEFT JOIN jabatans ON jabatans.kode_jabatanlama = pegawais.kode_jabatanlama
                                LEFT JOIN indeks ON indeks.kode_indeks = jabatans.indeks_id
                                LEFT JOIN indeks AS indeks_subkor_penyetaraan ON indeks_subkor_penyetaraan.kode_indeks = jabatans.indeks_subkor_penyetaraan_id
                                LEFT JOIN indeks AS indeks_subkor_non_penyetaraan ON indeks_subkor_non_penyetaraan.kode_indeks = jabatans.indeks_subkor_non_penyetaraan_id
                                LEFT JOIN indeks AS indeks_koor_penyetaraan ON indeks_koor_penyetaraan.kode_indeks = jabatans.indeks_koor_penyetaraan_id
                                LEFT JOIN indeks AS indeks_koor_non_penyetaraan ON indeks_koor_non_penyetaraan.kode_indeks = jabatans.indeks_koor_non_penyetaraan_id
                                LEFT JOIN jenis_jabatans ON jenis_jabatans.id = indeks.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_subkor_penyetaraan ON jenis_jabatan_subkor_penyetaraan.id = indeks_subkor_penyetaraan.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan ON jenis_jabatan_subkor_non_penyetaraan.id = indeks_subkor_non_penyetaraan.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_koor_penyetaraan ON jenis_jabatan_koor_penyetaraan.id = indeks_subkor_penyetaraan.jenis_jabatan_id
                                LEFT JOIN jenis_jabatans AS jenis_jabatan_koor_non_penyetaraan ON jenis_jabatan_koor_non_penyetaraan.id = indeks_subkor_non_penyetaraan.jenis_jabatan_id
                                LEFT JOIN opds ON opds.id = pegawais.opd_id
                                LEFT JOIN sub_opds ON sub_opds.id = pegawais.subopd_id 
                            WHERE
                                pegawais.tahun_id = $tahun 
                                AND pegawais.opd_id = $opd 
                            GROUP BY
                                jabatans.kode_jabatanlama,
                                jabatans.nama_jabatan,
                                opds.kode_opd,
                                opds.nama_opd,
                                jenis_jabatans.jenis_jabatan,
                                indeks.kelas_jabatan,
                                indeks.basic_tpp,
                                indeks.indeks, 
                                jabatans.nilai_jabatan 
                            ORDER BY
                                opds.nama_opd, 
                                pegawais.id ASC;
                    ");
        }

        return $data;
    }
}
