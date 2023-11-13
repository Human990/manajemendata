<?php

namespace App\Models;

use App\Models\Opd;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subopd extends Model
{
    use HasFactory;

    protected $guarded=[];
    protected $table = 'sub_opds';

    public static function data()
    {
        $data = Subopd::select('sub_opds.*', 'master_tahun.tahun','opds.nama_opd')
                        ->leftjoin('master_tahun', 'master_tahun.id', '=', 'sub_opds.tahun_id')
                        ->join('opds','opds.id','=','sub_opds.opd_id')
                        ->where('sub_opds.tahun_id', session()->get('tahun_id_session'))
                        ->orderBy('sub_opds.nama_sub_opd','ASC')
                        ->get();
        return $data;
    }

    public function opd()
    {
        return $this->belongsTo(Opd::class);
    }
}
