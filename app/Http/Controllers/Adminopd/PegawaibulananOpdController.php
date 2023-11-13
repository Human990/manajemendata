<?php

namespace App\Http\Controllers\Adminopd;

use App\Models\Tahun;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaibulananOpdController extends Controller
{

    public function index(Request $request)
    {
        $tahun_id = 0;

        try {
            $tahun_id = session()->get('tahun_id_session');
        } catch (\Throwable $th) {
            //throw $th;
        }
        $pagination = $request->input('recordsPerPage', 10);
        $search = $request->input('search');
        // $filter = $request->input('filter');
        $page = $request->input('page', 1);
        $query = Pegawai::data();
        
        // if (Auth::user()->role_id == 2 && Auth::user()->username == 'sekda') {
        //     $query = Pegawai::data()->where('pegawais.opd_id', '35')->whereNull(Auth::user()->kode_sub_opd);
        // } elseif (Auth::user()->role_id == 2 && Auth::user()->opd == 'guru'){
        //     $query = Pegawai::data()->where('pegawais.sts_pegawai', 'GURU');
        // } elseif (Auth::user()->role_id == 6 && Auth::user()->opd == 'bagian') {
        //     $query = Pegawai::data()->whereNull('sub_opds.kode_sub_opd', Auth::user()->kode_sub_opd);
        // } else {
        //     $query = Pegawai::data()->where('opds.kode_opd', Auth::user()->kode_opd);
        // }

        if (Auth::user()->role_id == 2 && Auth::user()->opd == 'guru'){
            $query = Pegawai::data()->where('pegawais.sts_pegawai', 'GURU');
        } else {
            $query = Pegawai::data()->where('opds.kode_sub_opd', Auth::user()->kode_sub_opd);
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pegawais.nip', 'like', "%$search%")
                    ->orWhere('pegawais.nama_pegawai', 'like', "%$search%")
                    ->orWhere('opds.nama_opd', 'like', "%$search%")
                    ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$search.'%');
            });
        }
        $datas = $query->paginate($pagination, ['*'], 'page', $page);

        return view('admin-opd.laporan.tpp-pegawai', compact('datas', 'search','pagination'));
    }

    public function putsession(Request $request)
    {
        session()->forget('tahun_id_session');
        session()->forget('tahun_session');

        session()->put('tahun_id_session', $request->tahun_id);
        session()->put('tahun_session', Tahun::where('id', $request->tahun_id)->value('tahun'));

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'eselon' => 'required',
            'total_bulan_penerimaan' => 'required',
        ]);

        Pegawai::create([

            'opd_id' => $request->opd_id,
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'sts_pegawai' => $request->sts_pegawai,
            'kode_jabatanlama' => $request->kode_jabatanlama,
            'sts_jabatan' => $request->sts_jabatan,
            'golongan' => $request->golongan,
            'pangkat' => $request->pangkat,
            'eselon' => $request->eselon,
            'pensiun' => $request->pensiun,
            'bulan_bk' => $request->bulan_bk,
            'bulan_pk' => $request->bulan_pk,
            'tpp' => $request->tpp,
            'tpp_tambahan' => $request->tpp_tambahan,
            'jft' => '',
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->route('adminopd-pegawai')->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
            'pangkat' => 'required',
            'golongan' => 'required',
            'eselon' => 'required',
            'total_bulan_penerimaan' => 'required',
        ]);
        
        $pegawai->update([
            'opd_id' => $request->opd_id,
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'sts_pegawai' => $request->sts_pegawai,
            'kode_jabatanlama' => $request->kode_jabatanlama,
            'sts_jabatan' => $request->sts_jabatan,
            'golongan' => $request->golongan,
            'pangkat' => $request->pangkat,
            'eselon' => $request->eselon,
            'pensiun' => $request->pensiun,
            'bulan_bk' => $request->bulan_bk,
            'bulan_pk' => $request->bulan_pk,
            'tpp' => $request->tpp,
            'tpp_tambahan' => $request->tpp_tambahan,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
