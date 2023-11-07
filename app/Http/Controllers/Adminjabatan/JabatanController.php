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
            $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.tunjab', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'jenis_jabatans.jenis_jabatan')
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
                            ->leftJoin('indeks', function ($join) use ($tahunid) {
                                $join->on('indeks.kode_indeks', '=', 'jabatans.indeks_id');
                                $join->on('indeks.tahun_id', '=', \DB::raw($tahunid));
                            })
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->where('jabatans.nama_jabatan', 'LIKE', '%'.$pencarian.'%')
                            ->orderBy('jabatans.created_at','DESC')
                            ->paginate(10);
        }else {
            $datas= Jabatan::select('jabatans.kode_jabatanlama AS id', 
                                    'jabatans.nama_jabatan', 
                                    'jabatans.nilai_jabatan', 
                                    'jabatans.indeks_id', 
                                    'jabatans.tunjab', 
                                    'master_tahun.tahun', 
                                    'indeks.kelas_jabatan', 
                                    'indeks.indeks', 
                                    'jenis_jabatans.jenis_jabatan')
                            ->leftjoin('master_tahun', 'master_tahun.id', '=', 'jabatans.tahun_id')
                            ->leftJoin('indeks', function ($join) use ($tahunid) {
                                $join->on('indeks.kode_indeks', '=', 'jabatans.indeks_id');
                                $join->on('indeks.tahun_id', '=', \DB::raw($tahunid));
                            })
                            ->leftjoin('jenis_jabatans', 'jenis_jabatans.id', '=', 'indeks.jenis_jabatan_id')
                            ->where('jabatans.tahun_id', session()->get('tahun_id_session'))
                            ->orderBy('jabatans.created_at','DESC')
                            ->paginate(10);
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
