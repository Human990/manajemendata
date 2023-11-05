<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catatan_opd extends Model
{
    use HasFactory;

    protected $guarded=[];

    public static function proses()
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon', 'pegawais.total_bulan_penerimaan')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->whereNull('status')
                            ->orderBy('catatan_opds.created_at','ASC')
                            ->get();

        return $data;
    }

    public static function ditindak_lanjuti()
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon', 'pegawais.total_bulan_penerimaan')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->whereNotNull('status')
                            ->orderBy('catatan_opds.created_at','ASC')
                            ->get();

        return $data;
    }

    public static function history($id)
    {
        $data = Catatan_opd::select('catatan_opds.*', 'pegawais.nip', 'pegawais.nama_pegawai', 'opds.nama_opd', 'master_tahun.tahun', 'pegawais.opd_id', 'pegawais.pangkat', 'pegawais.golongan', 'pegawais.eselon', 'pegawais.total_bulan_penerimaan')
                            ->join('pegawais', 'pegawais.id', '=', 'catatan_opds.pegawai_id')
                            ->join('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
                            ->join('opds', 'opds.id', '=', 'pegawais.opd_id')
                            ->where('catatan_opds.pegawai_id', $id)
                            ->orderBy('catatan_opds.created_at','ASC')
                            ->get();

        return $data;
    }
}
