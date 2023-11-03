<?php

namespace App\Http\Controllers\Adminjabatan;

use App\Models\Tahun;
use App\Models\Jabatanlama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MasterjabatanlamaController extends Controller
{
    public function index(Request $request)
    {
        $pagination = 20;
        $query = Jabatanlama::query();

        // Filter berdasarkan nama jabatan
        if ($request->has('search')) {
            $query->where('nama_jabatan', 'like', '%' . $request->input('search') . '%');
        }

        // Filter berdasarkan jenis jabatan, hanya jika form pencarian tidak diisi
        if (!$request->has('search') && $request->has('jenis_jabatan')) {
            $query->where('jenis_jabatan', $request->input('jenis_jabatan'));
        }

        // Lakukan paginasi dengan menyertakan parameter pencarian dan jenis_jabatan
        $jabatanlama = $query->orderBy('kode_jabatanlama', 'ASC')->paginate($pagination)
            ->appends(['search' => $request->input('search'), 'jenis_jabatan' => $request->input('jenis_jabatan')]);

        $viewIndeksData = DB::table('view_indeks_jabatanlama')->get();

        return view('admin-jabatan.master.master-jabatanlama', compact(['jabatanlama', 'viewIndeksData']))
            ->with('i', ($request->input('page', 1) - 1) * $pagination);
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

    public function putsession(Request $request)
    {
        session()->forget('tahunid_session');
        session()->forget('tahun_session');

        session()->put('tahun_id_session', $request->tahun_id);
        session()->put('tahun_session', Tahun::where('id', $request->tahun_id)->value('tahun'));

        return redirect()->back();
    }
}
