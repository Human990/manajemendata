<?php

namespace App\Models;

use App\Models\Subopd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opd extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static function data()
    {
        
        $data = Opd::select('opds.*', 'master_tahun.tahun', 'sub_opds.nama_sub_opd')
                ->leftjoin('master_tahun', 'master_tahun.id', '=', 'opds.tahun_id')
                ->leftJoin('sub_opds', 'sub_opds.id', '=', 'opds.subopd_id')
                ->where('opds.tahun_id', session()->get('tahun_id_session'));
        return $data;
    }

    public function subopds()
    {
        return $this->hasMany(Subopd::class);
    }
    

    // public function pegawai()
    // {
    //     return $this->hasMany(Pegawai::class, 'opd_id', 'id');
    // }

}
