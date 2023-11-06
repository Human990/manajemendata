<?php

namespace App\Models;

use App\Models\Opd;
use App\Models\Jabatan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static function data()
    {
        $tahunid = session()->get('tahun_id_session');
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
                                'jabatans.kode_jabatanlama', 
                                'jabatans.nama_jabatan', 
                                'jabatans.nilai_jabatan', 
                                'jabatans.indeks_id', 
                                'jabatans.tunjab', 
                                'master_tahun.tahun', 
                                'indeks.kelas_jabatan', 
                                'indeks.indeks', 
                                'jenis_jabatans.jenis_jabatan',
                                'opds.nama_opd'
                            )
                        ->leftjoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                        ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
                        ->leftJoin('indeks', 'indeks.kode_indeks', '=', 'jabatans.indeks_id')
                        ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', \DB::raw('CAST(indeks.jenis_jabatan AS INTEGER)'))
                        ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
                        ->orderBy('pegawais.id','ASC')
                        ->paginate(10);

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
