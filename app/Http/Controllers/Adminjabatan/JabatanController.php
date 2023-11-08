<?php

namespace App\Http\Controllers\Adminjabatan;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JabatanController extends Controller
{
    public function dashboard()
    {
        return view('admin-jabatan.master.dashboard');
    }

    public function index(Request $request)
    {
        $tahunid = session()->get('tahun_id_session');
        $pencarian = $request->pencarian;

        if (!empty($request->pencarian)) {
            $datas= Jabatan::pencarian($pencarian)->paginate(10);
        }else {
            $datas= Jabatan::daftar()->paginate(10);
        }

        return view('admin-jabatan.master.master-jabatan',compact('datas', 'pencarian'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nama_jabatan' => 'required',
            'nilai_jabatan' => 'required',
            'tunjab' => 'required',
        ]);

        Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
            'nilai_jabatan' => $request->nilai_jabatan,
            'tunjab' => $request->tunjab,
            'indeks_id' => $request->indeks_id,
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Jabatan $jabatan)
    {
        $this->validate($request, 
        [
            'nama_jabatan' => 'required',
            'nilai_jabatan' => 'required',
            'tunjab' => 'required',
        ]);
        
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
            'nilai_jabatan' => $request->nilai_jabatan,
            'tunjab' => $request->tunjab,
            'indeks_id' => $request->indeks_id,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
