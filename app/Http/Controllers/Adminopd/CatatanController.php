<?php

namespace App\Http\Controllers\Adminopd;

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

        return view('admin-kota.master.master-catatan-opd',compact('catatans', 'pencarian'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'catatan_opd' => 'required',
        ]);

        Catatan_opd::create([
            'pegawai_id' => $request->pegawai_id,
            'catatan_opd' => $request->catatan_opd,
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Catatan_opd $catatan)
    {
        $catatan->update([
            'catatan_opd' => $request->catatan_admin,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }

    public function destroy(Request $request, Catatan_opd $catatan)
    {
        $catatan->delete();

        return redirect()->back()->with('success','Data Berhasil Dihapus!');
    }
}
