<?php

namespace App\Models;

use App\Models\Pegbul;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opd extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static function data()
    {
        $data = Opd::select('opds.*', 'master_tahun.tahun')
                        ->leftjoin('master_tahun', 'master_tahun.id', '=', 'opds.tahun_id')
                        ->where('opds.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('opds.nama_opd','ASC')
                        ->get();

        return $data;
    }

    // public function pegawai()
    // {
    //     return $this->hasMany(Pegawai::class, 'opd_id', 'id');
    // }

}
