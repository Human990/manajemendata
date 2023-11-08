<?php

namespace App\Http\Controllers\Adminjabatan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Opd;
use Session;
use Auth;
use Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $id_user = Auth::user()->id;
        $user = User::where('id', $id_user)->first();
        $opd = Opd::where('kode_opd', Auth::user()->opd_id)->where('opds.tahun_id', session()->get('tahun_id_session'))->first();

        return view('admin-jabatan.profil.ubah_password', [
            'title' => 'Profil Pengguna',
            'user' => $user,
            'opd' => $opd,
        ]);
    }

    public function ubah_password(Request $request)
    {
        $this->validate($request, [
            'password_lama' => 'required',
            'password_baru' => 'required',
            'konfirmasi' => 'required|same:password_baru',
        ],
            [
                'password_lama.required' => 'Password Lama Harus Diisi!',
                'password_baru.required' => 'Password Baru Harus Diisi!',
                'konfirmasi.required' => 'Konfirmasi Harus Diisi!',
                'konfirmasi.same' => 'Konfirmasi Harus Sama Dengan Password Baru!',
            ]);

        if (Hash::make($request->password_lama) == Auth::user()->password) {
            session()->put('statusT', 'Password lama tidak sama');
        } else {
            $id_user = Auth::user()->id;
            $user = User::where('id', $id_user)->first();

            $user->fill([
                'password' => Hash::make($request->password_baru),
            ])->save();

            session()->put('statusY', 'Password berhasil Diubah');
        }

        return redirect()->back();
    }
}
