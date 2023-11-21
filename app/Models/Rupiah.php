<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rupiah extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $table="master_rupiah";
    protected $fillable=[
        'nama',
        'jumlah',
        'tahun_id',
        'asal_id',
        'flag',
    ];

    public static function bk()
    {
        $tahun = session()->get('tahun_id_session');
        $data = Rupiah::where('flag', 'beban_kerja')->where('tahun_id', $tahun)->value('jumlah');

        return $data;
    }

    public static function pk()
    {
        $tahun = session()->get('tahun_id_session');
        $data = Rupiah::where('flag', 'prestasi_kerja')->where('tahun_id', $tahun)->value('jumlah');

        return $data;
    }
    public static function tppGuruSertifikasi()
    {
        $tahun = session()->get('tahun_id_session');
        $data = Rupiah::where('flag', 'tpp_guru_sertifikasi')->where('tahun_id', $tahun)->value('jumlah');

        return $data;
    }
    public static function tppGuruBelumSertifikasi()
    {
        $tahun = session()->get('tahun_id_session');
        $data = Rupiah::where('flag', 'tpp_guru_belum_sertifikasi')->where('tahun_id', $tahun)->value('jumlah');

        return $data;
    }
    public static function tppPengawasSekolah()
    {
        $tahun = session()->get('tahun_id_session');
        $data = Rupiah::where('flag', 'tpp_pengawas_sekolah')->where('tahun_id', $tahun)->value('jumlah');

        return $data;
    }
    public static function tppKepalaSekolah()
    {
        $tahun = session()->get('tahun_id_session');
        $data = Rupiah::where('flag', 'tpp_kepala_sekolah')->where('tahun_id', $tahun)->value('jumlah');

        return $data;
    }
}
