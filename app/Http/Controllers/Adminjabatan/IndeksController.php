<?php

namespace App\Http\Controllers\Adminjabatan;

use App\Models\Indeks;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class IndeksController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) { 
            $datas = Indeks::data();
            $i = 1;
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('DT_RowIndex', function () use (&$i) {
                    return $i++;
                })
                ->addColumn('action', function ($data) {
                    $actionBtn = '<button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks' . $data->kode_indeks . '"><i class="fa fa-eye"></i> Ubah</button> 
                    <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $datas = Indeks::data();

        return view('admin-jabatan.master.master-indeks',compact('datas'));
    }
    

    public function store(Request $request)
    {
        $this->validate($request, 
        [
            'jenis_jabatan' => 'required',
            'kelas_jabatan' => 'required',
            'indeks' => 'required',
        ]);

        Indeks::create([
            'jenis_jabatan' => $request->jenis_jabatan,
            'kelas_jabatan' => $request->kelas_jabatan,
            'jenis_jabatan_id' => $request->jenis_jabatan,
            'indeks' => $request->indeks,
            'tahun_id' => session()->get('tahun_id_session'),
        ]);

        return redirect()->back()->with('success','Data Berhasil Disimpan!');
    }

    public function update(Request $request, Indeks $indeks)
    {
        $this->validate($request, 
        [
            'jenis_jabatan' => 'required',
            'kelas_jabatan' => 'required',
            'indeks' => 'required',
        ]);
        
        $indeks->update([
            'jenis_jabatan' => $request->jenis_jabatan,
            'kelas_jabatan' => $request->kelas_jabatan,
            'indeks' => $request->indeks,
            'jenis_jabatan_id' => $request->jenis_jabatan,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diupdate!');
    }
}
