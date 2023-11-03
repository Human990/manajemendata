<?php

namespace App\Http\Controllers\Adminjabatan;

use App\Models\Jabatanlama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MasterjabatanlamaController extends Controller
{
    public function index(Request $request)
    {
        $pagination = 20;
        $query = Jabatanlama::orderBy('kode_jabatanlama', 'ASC');

        // Filter berdasarkan jenis jabatan
        if ($request->has('jenis_jabatan') && in_array($request->jenis_jabatan, ['fungsional', 'struktural', 'pelaksana'])) {
            $query->where('jenis_jabatan', $request->jenis_jabatan);
        }

        // Pencarian berdasarkan nama jabatan
        if ($request->has('search')) {
            $query->where('nama_jabatan', 'like', '%' . $request->search . '%');
        }

        $jabatanlama = $query->paginate($pagination);
        $viewIndeksData = DB::table('view_indeks_jabatanlama')->get();

        return view('admin-jabatan.master.master-jabatanlama', compact(['jabatanlama', 'viewIndeksData']))->with('i', ($request->input('page', 1) - 1) * $pagination);
    }

    public function edit($kode_jabatanlama)
    {
        $jabatanlama = DB::table('jabatanlama')->where('kode_jabatanlama', $kode_jabatanlama)->first();

        return view('admin-jabatan.master.edit-jabatanlama', compact('jabatanlama'));
    }

    public function update(Request $request, $kode_jabatanlama)
    {
        // Validasi form edit
        $this->validate($request, [
            'nama_jabatan' => 'required|max:255',
            'jenis_jabatan' => 'required',
            'kelas_jabatan' => 'required',
            'nilai_jabatan' => 'required',
            'tunjab' => 'required',
        ]);

        // Update data
        DB::table('jabatanlama')
            ->where('kode_jabatanlama', $kode_jabatanlama)
            ->update([
                'nama_jabatan' => $request->nama_jabatan,
                'jenis_jabatan' => $request->jenis_jabatan,
                'kelas_jabatan' => $request->kelas_jabatan,
                'nilai_jabatan' => $request->nilai_jabatan,
                'tunjab' => $request->tunjab,
                // Tambahkan field lainnya sesuai kebutuhan
            ]);

        // Redirect ke halaman index atau halaman lainnya setelah update
        return redirect()->route('adminjabatan-jabatanlama')->with('success', 'Data berhasil diupdate.');
    }
}
