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
        return $this->hasMany(Pegbul::class, 'kode_jabatanlama', 'kode_jabatanlama');
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
