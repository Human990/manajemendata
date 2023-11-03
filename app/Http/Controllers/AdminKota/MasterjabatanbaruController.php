<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Jabatanbaru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MasterjabatanbaruController extends Controller
{
    public function index(Request $request)
    {
        $pagination=20;
        $jabatanbaru = Jabatanbaru::orderBy('kode_jabatanbaru','ASC')->paginate($pagination);
        $viewIndeksData = DB::table('view_indeks_jabatanbaru')->get();
        return view('admin-kota.master.master-jabatanbaru',compact(['jabatanbaru','viewIndeksData']))->with('i',($request->input('page',1)-1)*$pagination);
    }

    public function edit($kode_jabatanbaru)
    {
        $jabatanbaru = DB::table('jabatanbaru')->where('kode_jabatanbaru', $kode_jabatanbaru)->first();

        return view('admin-kota.master.edit-jabatanbaru', compact('jabatanbaru'));
    }

    public function update(Request $request, $kode_jabatanbaru)
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
        DB::table('jabatanbaru')
            ->where('kode_jabatanbaru', $kode_jabatanbaru)
            ->update([
                'nama_jabatan' => $request->nama_jabatan,
                'jenis_jabatan' => $request->jenis_jabatan,
                'kelas_jabatan' => $request->kelas_jabatan,
                'nilai_jabatan' => $request->nilai_jabatan,
                'tunjab' => $request->tunjab,
                // Tambahkan field lainnya sesuai kebutuhan
            ]);

        // Redirect ke habarun index atau habarun lainnya setelah update
        return redirect()->route('adminkota-jabatanbaru')->with('success', 'Data berhasil diupdate.');
    }
}
