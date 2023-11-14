<?php

namespace App\Http\Controllers\AdminKota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catatan_opd;

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
                    ->orWhere('opds.nama_opd', 'LIKE', '%'.$pencarian.'%');
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

    public function update(Request $request, Catatan_opd $catatan)
    {
        $catatan->update([
            'catatan_admin' => $request->catatan_admin,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
