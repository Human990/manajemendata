<?php

namespace App\Models;

use App\Models\Opd;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Auth;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static function data()
    {
        $tahunid = session()->get('tahun_id_session');

        if(Auth::user()->role_id == 1){
            $data = Pegawai::select('pegawais.id',
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
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }elseif(Auth::user()->role_id == 2 && Auth::user()->opd != 'guru') {
            $data = Pegawai::select('pegawais.id',
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
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->where('opds.kode_opd', Auth::user()->opd_id)
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }elseif(Auth::user()->role_id == 2 && Auth::user()->opd == 'guru') {
            $data = Pegawai::select('pegawais.id',
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
                                'master_tahun.tahun', 
                                'indeks.kelas_jabatan', 
                                'indeks.indeks', 
                                'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                'jenis_jabatans.jenis_jabatan',
                                'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan',
                                'opds.nama_opd'
                            )
                        ->leftjoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                        ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
                        ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                        ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                        ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                        ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                        ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                        ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                        ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->where('pegawais.sts_pegawai','GURU' )
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }

        return $data;
    }

    public static function filter($filter)
    {
        $tahunid = session()->get('tahun_id_session');

        if(Auth::user()->role_id == 1){
            $data = Pegawai::select('pegawais.id',
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
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('indeks.kode_indeks', $filter)
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }elseif(Auth::user()->role_id == 2 && Auth::user()->opd != 'guru') {
            $data = Pegawai::select('pegawais.id',
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
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('indeks.kode_indeks', $filter)
                        ->where('opds.kode_opd', Auth::user()->opd_id)
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }elseif(Auth::user()->role_id == 2 && Auth::user()->opd == 'guru') {
            $data = Pegawai::select('pegawais.id',
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
                                'master_tahun.tahun', 
                                'indeks.kelas_jabatan', 
                                'indeks.indeks', 
                                'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                'jenis_jabatans.jenis_jabatan',
                                'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan',
                                'opds.nama_opd'
                            )
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                            ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                            ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                            ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('indeks.kode_indeks', $filter)
                        ->where('pegawais.sts_pegawai', 'GURU')
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }

        return $data;
    }

    public static function pencarian($pencarian)
    {
        $tahunid = session()->get('tahun_id_session');

        if(Auth::user()->role_id == 1){
            $data = Pegawai::select('pegawais.id',
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
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where(function ($query) use ($pencarian) {
                            $query->where('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                                  ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                                  ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%');
                        })
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }elseif(Auth::user()->role_id == 2 && Auth::user()->opd != 'guru') {
            $data = Pegawai::select('pegawais.id',
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
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('opds.kode_opd', Auth::user()->opd_id)
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->where(function ($query) use ($pencarian) {
                            $query->where('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                                  ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                                  ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%');
                        })
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }elseif(Auth::user()->role_id == 2 && Auth::user()->opd == 'guru') {
            $data = Pegawai::select('pegawais.id',
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
                                'master_tahun.tahun', 
                                'indeks.kelas_jabatan', 
                                'indeks.indeks', 
                                'indeks_subkor_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_penyetaraan', 
                                'indeks_subkor_penyetaraan.indeks AS indeks_subkor_penyetaraan', 
                                'indeks_subkor_non_penyetaraan.kelas_jabatan AS kelas_jabatan_subkor_non_penyetaraan', 
                                'indeks_subkor_non_penyetaraan.indeks AS indeks_subkor_non_penyetaraan', 
                                'jenis_jabatans.jenis_jabatan',
                                'jenis_jabatan_subkor_penyetaraan.jenis_jabatan AS jenis_penyetaraan',
                                'jenis_jabatan_subkor_non_penyetaraan.jenis_jabatan AS jenis_non_penyetaraan',
                                'opds.nama_opd'
                            )
                        ->leftjoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                        ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
                        ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                        ->leftJoin('indeks AS indeks_subkor_penyetaraan', 'indeks_subkor_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_penyetaraan_id')
                        ->leftJoin('indeks AS indeks_subkor_non_penyetaraan', 'indeks_subkor_non_penyetaraan.kode_indeks', '=', 'jabatans.indeks_subkor_non_penyetaraan_id')
                        ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                        ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_penyetaraan', 'jenis_jabatan_subkor_penyetaraan.id', '=', 'indeks_subkor_penyetaraan.jenis_jabatan_id')
                        ->leftjoin('jenis_jabatans AS jenis_jabatan_subkor_non_penyetaraan', 'jenis_jabatan_subkor_non_penyetaraan.id', '=', 'indeks_subkor_non_penyetaraan.jenis_jabatan_id')
                        ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->where('pegawais.sts_pegawai', 'GURU')
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->where(function ($query) use ($pencarian) {
                            $query->where('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                                  ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                                  ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%');
                        })
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);
        }

        return $data;
    }

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'kode_jabatanlama', 'kode_jabatanlama');
    }

    public function opds()
    {
        return $this->belongsTo(Opd::class, 'opd_id', 'id');
    }
}
