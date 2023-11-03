<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Exports\PegawaiExport;
use App\Imports\PegawaiImport;
use Maatwebsite\Excel\Facades\Excel;

class MasterpegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pagination=20;
        $jumlah_pegawai = Pegawai::count();
        $pegawai= Pegawai::orderBy('id','ASC')->paginate($pagination);
        return view('master-pegawai',compact(['pegawai','jumlah_pegawai']))->with('i',($request->input('page',1)-1)*$pagination);
    }

    public function pegawaiexport()
    {
        return Excel::download(new PegawaiExport,'pegawai.xlsx');
    }

    public function pegawaiimportexcel(Request $request)
    {
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('DataPegawai',$namaFile);

        Excel::import(new PegawaiImport, public_path('/DataPegawai/'.$namaFile));
        return redirect()->route('master-pegawai')->with('success','Data Berhasil Di Import!');
    }
}
