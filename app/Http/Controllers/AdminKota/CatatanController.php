<?php

namespace App\Http\Controllers\AdminKota;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Catatan_opd;

class CatatanController extends Controller
{
    public function update(Request $request, Catatan_opd $catatan)
    {
        $catatan->update([
            'catatan_admin' => $request->catatan_admin,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
