<?php

namespace App\Http\Controllers\Adminopd;

use App\Models\Pegbul;
use App\Models\Rupiah;
use App\Models\Jabatanbaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaibulananOpdController extends Controller
{
    public function tpp(Request $request)
    {
        $user = Auth::user();
        $rupiah1 = Rupiah::where('id',1)->first();
        $rupiah2 = Rupiah::where('id',2)->first();
        $pegbul = Pegbul::with('jabatanbaru')->where('ukor_eselon2',$user->opd)->get();
        $jumlah_pegbul = $pegbul->count();
        $jabatanbaru = Jabatanbaru::all();
        return view('admin-opd.laporan.tpp-pegawai',compact(['pegbul','jumlah_pegbul','rupiah1','rupiah2','request']))->with('i',($request->input('page',1)-1));
    }
}
