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
        $pencarian = $request->pencarian;

        if (!empty($request->pencarian)) {
            $catatans= Catatan_opd::pencarian($pencarian)->whereNull('status')->paginate($pagination);
        }else {
            $catatans= Catatan_opd::data()->whereNull('status')->paginate($pagination);
        }

        return view('admin-kota.master.master-catatan',compact('catatans', 'pencarian','pagination'));
    }

    public function history(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $pencarian = $request->pencarian;

        if (!empty($request->pencarian)) {
            $catatans = Catatan_opd::pencarian($pencarian)->where('status', 'selesai')->paginate($pagination);
        } else {
            $catatans = Catatan_opd::data()->where('status', 'selesai')->paginate($pagination);
        }

        return view('admin-kota.master.master-catatan', compact('catatans', 'pencarian', 'pagination'));
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
