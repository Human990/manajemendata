<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Indeks extends Model
{
    use HasFactory;

    protected $guarded=[];

    public $table="indeks";

    protected $primaryKey = 'kode_indeks';
    
    protected $fillable = [
        'kode_indeks',
        'jenis_jabatan',
        'kelas_jabatan',
        'indeks',
        'tahun_id',
        'asal_id',
        'jenis_jabatan_id',
        'basic_tpp',
    ];

    public static function data()
    {
        $data = Indeks::select('indeks.*', 'master_tahun.tahun', 'jenis_jabatans.jenis_jabatan AS jenis_jabatan_baru')
                        ->leftjoin('master_tahun', 'master_tahun.id', '=', 'indeks.tahun_id')
                        ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                        ->where('indeks.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('indeks.jenis_jabatan','ASC')
                        ->orderBy('indeks.kelas_jabatan','ASC')
                        ->get();

        return $data;
    }
}
