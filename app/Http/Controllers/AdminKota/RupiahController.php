<?php

namespace App\Http\Controllers\Adminkota;

use App\Models\Rupiah;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RupiahController extends Controller
{
    public function index(Request $request)
    {
        $pagination=20;
        // $jumlah_pegawai = Pegawai::count();
        $rupiah= Rupiah::orderBy('id','ASC')->paginate($pagination);
        return view('admin-kota.master.master-rupiah',compact('rupiah'))->with('i',($request->input('page',1)-1)*$pagination);
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
        $requestData = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required',
        ]);
        Rupiah::create($requestData);
        return redirect()->route('adminkota-rupiah')->with('success','Data Berhasil Disimpan!');
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
        $rupiah = Rupiah::findorfail($id);
        return view('admin-kota.master.rupiah-edit',compact('rupiah'));
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
        $validatedData = $request->validate([
            'nama' => 'required',
            'jumlah' => 'required',
        ]);
        Rupiah::findorfail($id)
            ->update($validatedData);
            return redirect()->route('adminkota-rupiah')->with('success','Data Berhasil Diupdate!');
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
