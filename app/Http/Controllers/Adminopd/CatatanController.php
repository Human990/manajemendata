<?php

namespace App\Http\Controllers\Adminopd;

use App\Models\Catatan_opd;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CatatanController extends Controller
{
    public function index(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $pencarian = $request->input('pencarian');
        $query = Catatan_opd::data()->where('opds.kode_opd', Auth::user()->kode_opd);

        if ($pencarian) {
            $query->where(function ($q) use ($pencarian) {
                    $q->where('catatan_opds.catatan_opd', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('catatan_opds.catatan_admin', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('pegawais.nip', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('pegawais.nama_pegawai', 'LIKE', '%'.$pencarian.'%')
                    ->orWhere('opds.nama_opd', 'LIKE', '%'.$pencarian.'%');
            });
        }
        
        $catatans = $query->paginate($pagination);

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
