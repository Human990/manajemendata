<?php

namespace App\Http\Controllers\AdminKota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catatan_opd;

class CatatanController extends Controller
{
    public function index(Request $request)
    {
        $pencarian = $request->pencarian;

        if (!empty($request->pencarian)) {
            $catatans= Catatan_opd::pencarian($pencarian)->paginate(10);
        }else {
            $catatans= Catatan_opd::data()->paginate(10);
        }

        return view('admin-kota.master.master-catatan',compact('catatans', 'pencarian'));
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
