@extends('template.default')
@section('title','Master Pegawai')
@section('master-pegawai','active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Data Kepegawaian</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{route('admin.searchDakep')}}" class="form-inline" method="GET">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form> --}}
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importModal">Import</a>
            <a href="{{route('pegawaiexport')}}" class="btn btn-warning">Export</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Gelar Depan</th>
                            <th>Gelar Belakang</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Umur tahun</th>
                            <th>Umur bulan</th>
                            <th>Agama</th>
                            <th>Golongan Darah</th>
                            <th>Status Pernikahan</th>
                            <th>Alamat</th>
                            <th>No Telepon</th>
                            <th>Email</th>
                            <th>NIK</th>
                            <th>No NPWP</th>
                            <th>No Karpeg</th>
                            <th>KPE</th>
                            <th>No Taspen</th>
                            <th>No BPJS</th>
                            <th>No STPPL</th>
                            <th>tmt cpns</th>
                            <th>no sk cpns</th>
                            <th>tanggal sk cpns</th>
                            <th>golongan cpns</th>
                            <th>tmt pns</th>
                            <th>no sk pns</th>
                            <th>tanggal sk pns</th>
                            <th>jenis kelamin</th>
                            <th>BUP</th>
                            <th>tmt pensiun</th>
                            <th>golongan akhir</th>
                            <th>tmt golongan</th>
                            <th>masa kerja tahun</th>
                            <th>masa kerja bulan</th>
                            <th>jenis jabatan</th>
                            <th>eselon</th>
                            <th>tmt jabatan</th>
                            <th>nama jabatan</th>
                            <th>unit kerja</th>
                            <th>satuan kerja</th>
                            <th>jenjang pendidikan</th>
                            <th>nama pendidikan</th>
                            <th>no ijazah</th>
                            <th>tempat pendidikan</th>
                            <th>tahun lulus</th>
                            <th>diklat pengadaan</th>
                            <th>ked huk</th>
                            <th>lokasi kerja</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @foreach ($pegawai as $item)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$item->nip}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->gelar_depan}}</td>
                                <td>{{$item->gelar_belakang}}</td>
                                <td>{{$item->tempat_lahir}}</td>
                                <td>{{$item->tgl_lahir}}</td>
                                <td>{{$item->umur_tahun}}</td>
                                <td>{{$item->umur_bulan}}</td>
                                <td>{{$item->agama}}</td>
                                <td>{{$item->gol_darah}}</td>
                                <td>{{$item->status_pernikahan}}</td>
                                <td>{{$item->alamat}}</td>
                                <td>{{$item->no_telepon}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->nik}}</td>
                                <td>{{$item->no_npwp}}</td>
                                <td>{{$item->no_karpeg}}</td>
                                <td>{{$item->kpe}}</td>
                                <td>{{$item->no_taspen}}</td>
                                <td>{{$item->no_bpjs}}</td>
                                <td>{{$item->no_stppl}}</td>
                                <td>{{$item->tmt_cpns}}</td>
                                <td>{{$item->no_sk_cpns}}</td>
                                <td>{{$item->tgl_sk_cpns}}</td>
                                <td>{{$item->gol_cpns}}</td>
                                <td>{{$item->tmt_pns}}</td>
                                <td>{{$item->no_sk_pns}}</td>
                                <td>{{$item->tgl_sk_pns}}</td>
                                <td>{{$item->jenis_kelamin}}</td>
                                <td>{{$item->BUP}}</td>
                                <td>{{$item->tmt_pensiun}}</td>
                                <td>{{$item->gol_akhir}}</td>
                                <td>{{$item->tmt_golongan}}</td>
                                <td>{{$item->masa_kerja_tahun}}</td>
                                <td>{{$item->masa_kerja_bulan}}</td>
                                <td>{{$item->jenis_jabatan}}</td>
                                <td>{{$item->eselon}}</td>
                                <td>{{$item->tmt_jabatan}}</td>
                                <td>{{$item->nama_jabatan}}</td>
                                <td>{{$item->unit_kerja}}</td>
                                <td>{{$item->satuan_kerja}}</td>
                                <td>{{$item->jenjang_pendidikan}}</td>
                                <td>{{$item->nama_pendidikan}}</td>
                                <td>{{$item->no_ijazah}}</td>
                                <td>{{$item->tempat_pendidikan}}</td>
                                <td>{{$item->tahun_lulus}}</td>
                                <td>{{$item->diklat_pengadaan}}</td>
                                <td>{{$item->ked_huk}}</td>
                                <td>{{$item->lokasi_kerja}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Edit</a>
                                    <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <h6>jumlah data :{{$jumlah_pegawai}}</h6>
            {!!$pegawai->render()!!}
        </div>
        <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('pegawaiimportexcel')}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" required="required">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection