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
                                    'master_tahun.tahun', 
                                    'pegawais.opd_id',
                                    'pegawais.subopd_id', 
                                    'pegawais.pangkat',
                                    'pegawais.sts_jabatan',
                                    'pegawais.subkoor',
                                    'pegawais.nama_subkoor',
                                    'pegawais.sts_subkoor',
                                    'pegawais.bulan_bk',
                                    'pegawais.bulan_pk',
                                    'pegawais.golongan',
                                    'pegawais.pensiun', 
                                    'pegawais.eselon',
                                    'pegawais.tpp',
                                    'pegawais.sertifikasi_guru',
                                    'pegawais.pa_kpa',
                                    'pegawais.pbj',
                                    'pegawais.jft',)
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
