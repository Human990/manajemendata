<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tppbebankerja;

class TppbebankerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pagination=20;
        $jumlah_data = Tppbebankerja::count();
        $tppbebankerja= Tppbebankerja::query();

        // filter by tahun
        $tppbebankerja->when($request->tahun, function ($query) use ($request) {
            return $query->where('tahun', 'like', '%'.$request->tahun.'%');
        });
        // filter by bulan
        $tppbebankerja->when($request->bulan, function ($query) use ($request) {
            return $query->where('bulan', 'like', '%'.$request->bulan.'%');
        });
        // filter by unit
        $tppbebankerja->when($request->unit, function ($query) use ($request) {
            return $query->where('unit', 'like', '%'.$request->unit.'%');
        });
        // filter by status pegawai
        $tppbebankerja->when($request->status_pegawai, function ($query) use ($request) {
            return $query->where('status_pegawai', 'like', '%'.$request->status_pegawai.'%');
        });

        return view('tpp-beban-kerja',(['tppbebankerja' => $tppbebankerja->paginate(20),'jumlah_data' => $jumlah_data]))->with('i',($request->input('page',1)-1)*$pagination);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
