<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Opd;
// use App\Models\Pegbul;
use App\Models\Tahun;
use App\Models\Rupiah;
use App\Models\Pegawai;
use App\Models\Catatan_opd;
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
        $jumlah_pegawai = Pegawai::count();
        $rupiah3 = Rupiah::where('id', 3)->first();
        $rupiah4 = Rupiah::where('id', 4)->first();
        // tambahkan rumus untuk total_tpp, belum bisa karena indeks dan jabatan belum fix
        $jumlahguru = Pegawai::where('sts_pegawai','guru')->count();
        $rs = Pegawai::where('sts_pegawai','rs')->count();
        $pppk = Pegawai::where('sts_pegawai','pppk')->count();
        $catatans = Catatan_opd::proses()->paginate(10);

        return view('admin-kota.laporan.anggaran',compact(['jumlah_pegawai','rupiah3','rupiah4','jumlahguru','rs','pppk', 'catatans']))->with('i',($request->input('page',1)-1));
    }

    public function putsession(Request $request)
    {
        session()->forget('tahunid_session');
        session()->forget('tahun_session');

        session()->put('tahun_id_session', $request->tahun_id);
        session()->put('tahun_session', Tahun::where('id', $request->tahun_id)->value('tahun'));

        return redirect()->back();
    }
}
