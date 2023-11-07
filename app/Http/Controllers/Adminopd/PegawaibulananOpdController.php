<?php

namespace App\Http\Controllers\Adminopd;

use App\Models\Tahun;
use App\Models\Pegbul;
use App\Models\Rupiah;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Jabatanbaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaibulananOpdController extends Controller
{
    // public function index(Request $request)
    // {
    //     $user = Auth::user();
    //     $rupiah1 = Rupiah::where('id',1)->first();
    //     $rupiah2 = Rupiah::where('id',2)->first();
    //     $pegbul = Pegawai::with('jabatanbaru')->where('opd_id',$user->opd_id)->get();
    //     $jumlah_pegbul = $pegbul->count();
    //     $jabatanbaru = Jabatan::all();
    //     return view('admin-opd.laporan.tpp-pegawai',compact(['pegbul','jumlah_pegbul','rupiah1','rupiah2','request']))->with('i',($request->input('page',1)-1));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $datas = Pegawai::select(
            'pegawais.*',
            'master_tahun.tahun',
            'jabatans.nama_jabatan',
            'opds.nama_opd'
        )
        ->leftJoin('master_tahun', 'master_tahun.id', '=', 'pegawais.tahun_id')
        ->leftJoin('jabatans', 'jabatans.kode_jabatanlama', '=', 'pegawais.kode_jabatanlama')
        ->leftJoin('opds', 'opds.id', '=', 'pegawais.opd_id')
        ->where('pegawais.tahun_id', session()->get('tahun_id_session'))
        ->when($search, function ($query) use ($search) {
            $query->where('nama_pegawai', 'LIKE', '%' . $search . '%')
                  ->orWhere('nip', 'LIKE', '%' . $search . '%');
        })
        ->orderBy('pegawais.id', 'ASC')
        ->paginate(10);

    return view('admin-opd.laporan.tpp-pegawai', compact('datas','search'));
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
