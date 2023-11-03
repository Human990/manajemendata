<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Pegbul;
use App\Models\Rupiah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PegawaibulananController extends Controller
{
    public function tpp(Request $request)
    {
        
        if($request->has('cari')){
            
            $rupiah1 = Rupiah::where('id',1)->first();
            $rupiah2 = Rupiah::where('id',2)->first();
            $pegbul = Pegbul::where('opd','like','%' . $request->cari . '%')->get();
            $jumlah_pegbul = Pegbul::where('opd','like','%' . $request->cari . '%')->count();
            return view('admin-kota.laporan.tpp-pegawai',compact(['pegbul','jumlah_pegbul','rupiah1','rupiah2','request']))->with('i',($request->input('page',1)-1));
        }else{
            $jumlah_pegbul = Pegbul::count();
            $rupiah1 = Rupiah::where('id',1)->first();
            $rupiah2 = Rupiah::where('id',2)->first();
            $pegbul = Pegbul::all();
            return view('admin-kota.laporan.tpp-pegawai',compact(['pegbul','jumlah_pegbul','rupiah1','rupiah2','request']))->with('i',($request->input('page',1)-1));
        }
        
    }

    public function totaltpp(Request $request)
    {
        $jumlah_pegbul = Pegbul::count();
        $rupiah1 = Rupiah::where('id',1)->first();
        $rupiah2 = Rupiah::where('id',2)->first();
        $rupiah3 = Rupiah::where('id', 3)->first();
        $rupiah4 = Rupiah::where('id', 4)->first();
        // $pegbul = Pegbul::select('opd')->groupBy('opd')->get();
        $pegbul = DB::table('view_tpp')->get();
        return view('admin-kota.laporan.tpp-total',compact(['pegbul','jumlah_pegbul','rupiah1','rupiah2','rupiah3','rupiah4']))->with('i',($request->input('page',1)-1));
    }

    public function anggaran(Request $request)
    {
        $jumlah_pegbul = Pegbul::count();
        $rupiah1 = Rupiah::where('id',1)->first();
        $rupiah2 = Rupiah::where('id',2)->first();
        $rupiah3 = Rupiah::where('id', 3)->first();
        $rupiah4 = Rupiah::where('id', 4)->first();
        // $pegbul = Pegbul::select('opd')->groupBy('opd')->get();
        $pegbul = DB::table('view_tpp')->get();
        $jumlahguru = DB::table('view_jumlahguru')->first();
        $rs = DB::table('view_jumlahrs')->first();
        $pppk = DB::table('view_jumlahpppk')->first();
        return view('admin-kota.laporan.anggaran',compact(['pegbul','jumlah_pegbul','rupiah1','rupiah2','rupiah3','rupiah4','jumlahguru','rs','pppk']))->with('i',($request->input('page',1)-1));
    }
}
