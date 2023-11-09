<?php

namespace App\Models;

use App\Models\Indeks;
use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $guarded=[];

    protected $primaryKey = 'kode_jabatanlama';

    public static function daftar(){
        $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.tunjab', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.nilai_jabatan_subkor_penyetaraan', 
                                    'jabatans.nilai_jabatan_subkor_non_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_murni', 
                                    'jabatans.prosentase_penerimaan_subkor_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_subkor_non_penyetaraan', 
                                    'jabatans.indeks_koor_penyetaraan_id', 
                                    'jabatans.indeks_koor_non_penyetaraan_id', 
                                    'jabatans.nilai_jabatan_koor_penyetaraan', 
                                    'jabatans.nilai_jabatan_koor_non_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_koor_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_koor_non_penyetaraan', 
                                    'jabatans.tunjab_subkor', 
                                    'jabatans.tunjab_koor', 
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
                                    'jenis_jabatan_koor_non_penyetaraan.jenis_jabatan AS jenis_koor_non_penyetaraan'
                                )
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
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
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->orderBy('jabatans.created_at','DESC');
        
        return $datas;
    }

    public static function pencarian($pencarian){
        $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.tunjab', 
                                    'jabatans.indeks_subkor_penyetaraan_id', 
                                    'jabatans.indeks_subkor_non_penyetaraan_id', 
                                    'jabatans.nilai_jabatan_subkor_penyetaraan', 
                                    'jabatans.nilai_jabatan_subkor_non_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_murni', 
                                    'jabatans.prosentase_penerimaan_subkor_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_subkor_non_penyetaraan', 
                                    'jabatans.indeks_koor_penyetaraan_id', 
                                    'jabatans.indeks_koor_non_penyetaraan_id', 
                                    'jabatans.nilai_jabatan_koor_penyetaraan', 
                                    'jabatans.nilai_jabatan_koor_non_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_koor_penyetaraan', 
                                    'jabatans.prosentase_penerimaan_koor_non_penyetaraan', 
                                    'jabatans.tunjab_subkor', 
                                    'jabatans.tunjab_koor', 
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
                                    'jenis_jabatan_koor_non_penyetaraan.jenis_jabatan AS jenis_koor_non_penyetaraan'
                                )
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
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
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->where('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%')
                            ->orderBy('jabatans.created_at','DESC');

        return $datas;
    }

    public static function data(){
        $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.tunjab', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'jenis_jabatans.jenis_jabatan')
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
                            ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->orderBy('jabatans.nama_jabatan','ASC')
                            ->get();
        
        return $datas;
    }

    public function pegbul()
    {
        return $this->hasMany(Pegawai::class, 'kode_jabatanlama', 'kode_jabatanlama');
    }

    public function indeks()
    {
        return $this->belongsTo(Indeks::class, 'indeks_id', 'kode_indeks');
    }

    // public function pegawai()
    // {
    //     return $this->hasMany(Pegawai::class, 'kode_jabatanlama', 'kode_jabatanlama');
    // }
}
