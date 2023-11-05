<?php

namespace App\Http\Controllers\Adminopd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catatan_opd;

class CatatanController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'catatan_opd' => 'required',
        ]);

        Catatan_opd::create([
            'pegawai_id' => $request->pegawai_id,
            'catatan_opd' => $request->catatan_opd,
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }
}
