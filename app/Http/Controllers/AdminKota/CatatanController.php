<?php

namespace App\Http\Controllers\AdminKota;

use App\Models\Pegawai;
use App\Models\Catatan_opd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CatatanController extends Controller
{
    public function daftar(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $pencarian = $request->input('pencarian');
        $filteropd = $request->input('filteropd'); // Data filter
        $query = Catatan_opd::data();

        if ($pencarian) {
            $query->where(function ($q) use ($pencarian) {
                    $q->where('catatan_opds.catatan_opd', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('catatan_opds.catatan_admin', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('opds.nama_opd', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%');
            });
        }
        if ($filteropd) {
            $query->where('pegawais.opd_id', $filteropd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }
        $catatans = $query->whereNull('status')->paginate($pagination);

        return view('admin-kota.master.master-daftar-catatan',compact('catatans', 'pencarian','pagination','filteropd'));
    }

    public function history(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $pencarian = $request->input('pencarian');
        $query = Catatan_opd::data();
        $filteropd = $request->input('filteropd');
        if ($pencarian) {
            $query->where(function ($q) use ($pencarian) {
                    $q->where('catatan_opds.catatan_opd', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('catatan_opds.catatan_admin', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('opds.nama_opd', 'LIKE', '%'.$pencarian.'%');
            });
        }
        if ($filteropd) {
            $query->where('pegawais.opd_id', $filteropd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }
        $catatans = $query->where('status','selesai')->paginate($pagination);

        return view('admin-kota.master.master-catatan', compact('filteropd','catatans', 'pencarian', 'pagination'));
    }


    public function updatecatatan(Request $request, Catatan_opd $catatan)
    {
        $this->validate($request, [
            'catatan_admin' => 'required',
            'status' => 'required',
            // Add validation rules for other fields
        ]);

        $catatan->update([
            'catatan_admin' => $request->catatan_admin,
            'status' => $request->status,
            // Add other Catatan_opd fields
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }

    public function updatepegawai(Request $request, Catatan_opd $catatan)
    {

        $this->validate($request, [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'catatan_admin' => 'required',
            'status' => 'required',
            // Add validation rules for other fields
        ]);
        
        $pegawai = Pegawai::data()->where('pegawais.id', $catatan->pegawai_id)->first();
        if ($pegawai) {
            $pegawai->update([
                'opd_id' => $request->opd_id,
                'nip' => $request->nip,
                'nama_pegawai' => $request->nama_pegawai,
                'sts_pegawai' => $request->sts_pegawai,
                'guru_nonguru' => $request->guru_nonguru,
                'kode_jabatanlama' => $request->kode_jabatanlama,
                'subopd_id' => $request->subopd_id,
                'sts_jabatan' => $request->sts_jabatan,
                'golongan' => $request->golongan,
                'pangkat' => $request->pangkat,
                'eselon' => $request->eselon,
                'pensiun' => $request->pensiun,
                'bulan_bk' => $request->bulan_bk,
                'bulan_pk' => $request->bulan_pk,
                'tpp' => $request->tpp,
                // 'tpp' => 'Penerima TPP',
                'tpp_tambahan' => $request->tpp_tambahan,
                'subkoor' => $request->subkoor,
                'nama_subkoor' => $request->nama_subkoor,
                'sts_subkoor' => $request->sts_subkoor,
                'sertifikasi_guru' => $request->sertifikasi_guru,
                'pa_kpa' => $request->pa_kpa,
                'pbj' => $request->pbj,
                'jft' => $request->jft,
            ]);
        }

        $catatan->update([
            'catatan_admin' => $request->catatan_admin,
            'status' => $request->status,
            // Add other Catatan_opd fields
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
