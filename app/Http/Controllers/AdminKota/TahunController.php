<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Tahun;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TahunController extends Controller
{
    public function index(Request $request)
    {
        $pagination=20;
        // $jumlah_pegawai = Pegawai::count();
        $tahun= Tahun::orderBy('id','ASC')->paginate($pagination);
        return view('admin-kota.master.master-tahun',compact('tahun'))->with('i',($request->input('page',1)-1)*$pagination);
    }

    public function store(Request $request)
    {
        $requestData = $request->validate([
            'tahun' => 'required',
            'keterangan' => 'nullable',
        ]);

        Tahun::create($requestData);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $tahun = Tahun::findorfail($id);
        return view('admin-kota.master.tahun-edit',compact('tahun'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'tahun' => 'required',
            'keterangan' => 'nullable',
        ]);
        Tahun::findorfail($id)
            ->update($validatedData);
            return redirect()->route('adminkota-tahun')->with('success','Data Berhasil Diupdate!');
    }
}
