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
        $search = $request->input('search');
        $pagination = $request->input('recordsPerPage', 10);
        $sorting = $request->input('sorting');
        $query = Jabatan::daftar();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('jabatans.nama_jabatan', 'LIKE', '%'.$search.'%');
            });
        }

        switch ($sorting) {
            case 'murni':
                $query->whereNull('jabatans.indeks_id');
                break;
            case 'subkoor':
                $query->whereNull('jabatans.indeks_subkor_penyetaraan_id')
                      ->whereNull('jabatans.indeks_subkor_non_penyetaraan_id')
                      ->whereNull('jabatans.nilai_jabatan_subkor_penyetaraan')
                      ->whereNull('jabatans.nilai_jabatan_subkor_non_penyetaraan');
                break;
            case 'koor':
                $query->whereNull('jabatans.indeks_koor_penyetaraan_id')
                      ->whereNull('jabatans.indeks_koor_non_penyetaraan_id')
                      ->whereNull('jabatans.nilai_jabatan_koor_penyetaraan')
                      ->whereNull('jabatans.nilai_jabatan_koor_non_penyetaraan');
                break;
            default:
                // Default sorting jika tidak ada yang dipilih
                break;
        }

        // Memanggil metode data() pada model Pegawai
        $datas = $query->paginate($pagination);

        return view('admin-jabatan.master.master-jabatan',compact('datas', 'search','pagination','sorting'));
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
            'indeks_subkor_penyetaraan_id' => $request->indeks_subkor_penyetaraan_id,
            'indeks_subkor_non_penyetaraan_id' => $request->indeks_subkor_non_penyetaraan_id,
            'nilai_jabatan_subkor_penyetaraan' => $request->nilai_jabatan_subkor_penyetaraan,
            'nilai_jabatan_subkor_non_penyetaraan' => $request->nilai_jabatan_subkor_non_penyetaraan,
            'prosentase_penerimaan_murni' => $request->prosentase_penerimaan_murni,
            'prosentase_penerimaan_subkor_penyetaraan' => $request->prosentase_penerimaan_subkor_penyetaraan,
            'prosentase_penerimaan_subkor_non_penyetaraan' => $request->prosentase_penerimaan_subkor_non_penyetaraan,

            'indeks_koor_penyetaraan_id' => $request->indeks_koor_penyetaraan_id,
            'indeks_koor_non_penyetaraan_id' => $request->indeks_koor_non_penyetaraan_id,
            'nilai_jabatan_koor_penyetaraan' => $request->nilai_jabatan_koor_penyetaraan,
            'nilai_jabatan_koor_non_penyetaraan' => $request->nilai_jabatan_koor_non_penyetaraan,
            'prosentase_penerimaan_koor_penyetaraan' => $request->prosentase_penerimaan_koor_penyetaraan,
            'prosentase_penerimaan_koor_non_penyetaraan' => $request->prosentase_penerimaan_koor_non_penyetaraan,

            'tunjab' => $request->tunjab,
            'tunjab_subkor' => $request->tunjab_subkor,
            'tunjab_koor' => $request->tunjab_koor,
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
            'indeks_subkor_penyetaraan_id' => $request->indeks_subkor_penyetaraan_id,
            'indeks_subkor_non_penyetaraan_id' => $request->indeks_subkor_non_penyetaraan_id,
            'nilai_jabatan_subkor_penyetaraan' => $request->nilai_jabatan_subkor_penyetaraan,
            'nilai_jabatan_subkor_non_penyetaraan' => $request->nilai_jabatan_subkor_non_penyetaraan,
            'prosentase_penerimaan_murni' => $request->prosentase_penerimaan_murni,
            'prosentase_penerimaan_subkor_penyetaraan' => $request->prosentase_penerimaan_subkor_penyetaraan,
            'prosentase_penerimaan_subkor_non_penyetaraan' => $request->prosentase_penerimaan_subkor_non_penyetaraan,
            
            'indeks_koor_penyetaraan_id' => $request->indeks_koor_penyetaraan_id,
            'indeks_koor_non_penyetaraan_id' => $request->indeks_koor_non_penyetaraan_id,
            'nilai_jabatan_koor_penyetaraan' => $request->nilai_jabatan_koor_penyetaraan,
            'nilai_jabatan_koor_non_penyetaraan' => $request->nilai_jabatan_koor_non_penyetaraan,
            'prosentase_penerimaan_koor_penyetaraan' => $request->prosentase_penerimaan_koor_penyetaraan,
            'prosentase_penerimaan_koor_non_penyetaraan' => $request->prosentase_penerimaan_koor_non_penyetaraan,

            'tunjab' => $request->tunjab,
            'tunjab_subkor' => $request->tunjab_subkor,
            'tunjab_koor' => $request->tunjab_koor,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
