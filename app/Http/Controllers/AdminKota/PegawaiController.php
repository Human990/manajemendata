<?php

namespace App\Http\Controllers\AdminKota;

// use App\Models\Pegbul;
use App\Models\Jabatan;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $pagination = $request->input('recordsPerPage', 10);
        $search = $request->input('search'); // Data pencarian
        $filteropd = $request->input('filteropd'); // Data filter
        $filtersubopd = $request->input('filtersubopd'); // Data filter
        $query = Pegawai::data();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pegawais.nip', 'like', "%$search%")
                    ->orWhere('pegawais.nama_pegawai', 'like', "%$search%");
                    // ->orWhere('opds.nama_opd', 'like', "%$search%")
                    // ->orWhere('jabatans.nama_jabatan', 'LIKE', '%'.$search.'%');
            });
        }

         // Menambahkan kondisi where untuk filter jika ada
        if ($filteropd) {
            $query->where('pegawais.opd_id', $filteropd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }
        if ($filtersubopd) {
            $query->where('pegawais.subopd_id',$filtersubopd);
            // Tambahkan kondisi filter untuk kolom lainnya
        }

        // Memanggil metode data() pada model Pegawai
        $datas = $query->paginate($pagination);

        return view('admin-kota.master.data-pegawai', compact('datas', 'pagination', 'search','filteropd','filtersubopd'));
    }

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
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
            'subkoor' => $request->subkoor,
            'nama_subkoor' => $request->nama_subkoor,
            'sts_subkoor' => $request->sts_subkoor,
            'jft' => '',
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->route('adminkota-pegawai')->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, 
        [
            'nip' => 'required',
            'nama_pegawai' => 'required',
        ]);
        
        $pegawai->update([
            'opd_id' => $request->opd_id,
            'nip' => $request->nip,
            'nama_pegawai' => $request->nama_pegawai,
            'sts_pegawai' => $request->sts_pegawai,
            'kode_jabatanlama' => $request->kode_jabatanlama,
            'subopd_id' => $request->subopd_id,
            'sts_jabatan' => $request->sts_jabatan,
            'golongan' => $request->golongan,
            'pangkat' => $request->pangkat,
            'eselon' => $request->eselon,
            'pensiun' => $request->pensiun,
            'bulan_bk' => $request->bulan_bk,
            'bulan_pk' => $request->bulan_pk,
            'tpp' => $request->tpp,
            // 'tpp' => 'Penerima TPP',
            'tpp_tambahan' => $request->tpp_tambahan,
            'subkoor' => $request->subkoor,
            'nama_subkoor' => $request->nama_subkoor,
            'sts_subkoor' => $request->sts_subkoor,
            'sertifikasi_guru' => $request->sertifikasi_guru,
            'pa_kpa' => $request->pa_kpa,
            'pbj' => $request->pbj,
            'jft' => $request->jft,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->delete();

        return redirect()->back()->with('success','Data Berhasil Dihapus!');
    }
}
