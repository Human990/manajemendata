<?php

namespace App\Http\Controllers\AdminKota;

use App\Models\Indeks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndeksController extends Controller
{
    public function index(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $datas= Indeks::select('indeks.*', 'master_tahun.tahun', 'jenis_jabatans.jenis_jabatan AS jenis_jabatan_baru')
                    ->leftjoin('master_tahun', 'master_tahun.id', '=', 'indeks.tahun_id')
                    ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                    ->where('indeks.tahun_id', session()->get('tahun_id_session'))
                    ->orderBy('indeks.jenis_jabatan','ASC')
                    ->orderBy('indeks.kelas_jabatan','ASC')
                    ->paginate($pagination);

        return view('admin-kota.master.master-indeks',compact('datas','pagination'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'jenis_jabatan' => 'required',
            'kelas_jabatan' => 'required',
            'indeks' => 'required',
        ]);

        Indeks::create([
            'jenis_jabatan' => $request->jenis_jabatan,
            'kelas_jabatan' => $request->kelas_jabatan,
            'jenis_jabatan_id' => $request->jenis_jabatan,
            'indeks' => $request->indeks,
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Indeks $indeks)
    {
        $this->validate($request, 
        [
            'jenis_jabatan' => 'required',
            'kelas_jabatan' => 'required',
            'indeks' => 'required',
        ]);
        
        $indeks->update([
            'jenis_jabatan' => $request->jenis_jabatan,
            'kelas_jabatan' => $request->kelas_jabatan,
            'indeks' => $request->indeks,
            'jenis_jabatan_id' => $request->jenis_jabatan,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
