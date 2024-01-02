<?php

namespace App\Models;

use App\Models\Opd;
use App\Models\Subopd;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }

    public function catatan_opd()
    {
        return $this->hasOne(Catatan_opd::class, 'pegawai_id');
    }

    public function subopd()
    {
        return $this->belongsTo(Subopd::class);
    }

    public function jabatan()
    {
        return $this->belongsTo('App\Models\Jabatan', 'kode_jabatanlama', 'kode_jabatanlama');
    }

    public function indeks()
    {
        return $this->belongsTo('App\Models\Indeks', 'kode_indeks', 'indeks_id');
    }

    public static function data()
    {
        $data = Pegawai::select('pegawais.id',
                                'pegawais.nip', 
                                'pegawais.nama_pegawai',
                                'pegawais.guru_nonguru', 
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
                                'pegawais.jabatan_atasan',
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
                                'opds.kode_opd',
                                'sub_opds.nama_sub_opd',
                                'sub_opds.kode_sub_opd'
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
                        ->leftJoin('sub_opds', 'sub_opds.id', '=', 'pegawais.subopd_id')
                        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('pegawais.atasan_nip', 'ASC');
        return $data;
    }

    public static function jumlah_bulan($jenis, $pegawai)
    {
        if($jenis == 'bk'){
            $data = Pegawai::where('id', $pegawai)->value('bulan_bk');
        }

        if ($jenis == 'pk') {
            $data = Pegawai::where('id', $pegawai)->value('bulan_pk');
        }

        return $data;
    }
    
}
