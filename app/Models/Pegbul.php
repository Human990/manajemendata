<?php

namespace App\Models;

use App\Models\OPD;
use App\Models\Indeks;
use App\Models\Jabatan;
use App\Models\Jabatanbaru;
use App\Models\Jabatanlama;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegbul extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $table="pegawai_bulanan";
    protected $fillable = [
        'kode_opd',
        'kode_jabatan',
        'kode_indeks',
        'ukor_eselon2',
        'ukor_eselon3',
        'ukor_eselon4',
        'nip',
        'nama_pegawai',
        'sts_pegawai',
        'sts_jabatan',
        'pangkat',
        'eselon',
        'indeks',
        'tpp',
        'sertifikasi_guru',
        'pa_kpa',
        'pbj',
        'jft',
        'subkoor',
        'nama_subkoor',
        'sts_subkoor',
        'atasan_nip',
        'atasan_nama',
        'atasannya_atasan_nip',
        'atasannya_atasan_nama',
        'bulan',
        'tahun',
        'pensiun',
        'tpp_tambahan',
        'jumlah_pemangku',
        'basic_tpp',
        'jenis_evidence_bk',
        'jenis_evidence_pk',
        'jenis_evidence_kk',
        'jenis_evidence_tb',
        'jenis_evidence_kp',
    ];

    public function jabatans()
    {
        return $this->belongsTo(Jabatan::class, 'kode_jabatanlama', 'kode_jabatanlama');
    }

    public function jabatanbaru() {
        return $this->belongsTo(Jabatanbaru::class,'kode_jabatanbaru','kode_jabatanbaru');
    }

}
