<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan_opd extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static function data()
    {
        $data = Catatan_opd::select('catatan_opds.*',
                                    'pegawais.kode_jabatanlama',
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
                                    'pegawais.opd_id', 
                                    'pegawais.bulan_bk',
                                    'pegawais.bulan_pk',
                                    'pegawais.pensiun',
                                    'pegawais.subkoor',
                                    'pegawais.nama_subkoor',
                                    'pegawais.sts_subkoor',
                                    'pegawais.golongan',
                                    'pegawais.tpp',
                                    'pegawais.sertifikasi_guru',
                                    'pegawais.pa_kpa',
                                    'pegawais.pbj',
                                    'pegawais.jft',
                                    'pegawais.atasan_nama',
                                    'pegawais.atasan_nip',
                                    'pegawais.atasannya_atasan_nip',
                                    'pegawais.atasannya_atasan_nama',
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
                                    'opds.nama_opd',
                                    'sub_opds.nama_sub_opd')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->leftJoin('sub_opds', 'sub_opds.id', '=', 'pegawais.subopd_id')
                            ->join('jabatans','jabatans.kode_jabatanlama','=','pegawais.kode_jabatanlama')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_koor_penyetaraan', 'indeks_koor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_koor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_koor_non_penyetaraan', 'indeks_koor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_koor_non_penyetaraan_id')
                            ->leftJoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->leftJoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftJoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->leftJoin('jenis_jabatans AS jenis_jabatan_koor_penyetaraan', 'jenis_jabatan_koor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftJoin('jenis_jabatans AS jenis_jabatan_koor_non_penyetaraan', 'jenis_jabatan_koor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->orderBy('catatan_opds.created_at','ASC');
        return $data;
    }

    public static function pencarian($pencarian)
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->where('catatan_opds.catatan_opd', 'LIKE', '%'.$pencarian.'%')
                            ->orWhere('catatan_opds.catatan_admin', 'LIKE', '%'.$pencarian.'%')
                            ->orWhere('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                            ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                            ->orWhere('opds.nama_opd', 'LIKE', '%'.$pencarian.'%')
                            ->orderBy('catatan_opds.created_at','ASC');

        return $data;
    }

    public static function proses()
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->whereNull('status')
                            ->orderBy('catatan_opds.created_at','ASC');

        return $data;
    }

    public static function ditindak_lanjuti()
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->whereNotNull('status')
                            ->orderBy('catatan_opds.created_at','ASC');

        return $data;
    }

    public static function history($id)
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->where('catatan_opds.pegawai_id', $id)
                            ->orderBy('catatan_opds.created_at','ASC');

        return $data;
    }
}
