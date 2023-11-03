@extends('template.default')
@section('title','Pegawai Bulanan')
@section('pegawai-bulanan','active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Pegawai Bulanan All OPD</h3>
        </div>
        <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importpegbulModal">Import</a>
            <a href="#" class="btn btn-warning">Export</a>
            {{-- <a href="{{route('tpp-pegawai')}}" class="btn btn-success">Rekap TPP</a> --}}
        </div>

        {{-- filter --}}
        {{-- <div class="card-body">
            <form action="#" method="get">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="" class="form-label">Tahun</label>
                        <input name="tahun" type="text" class="form-control" placeholder="tahun" value="{{isset($_GET['tahun']) ? $_GET['tahun'] : ''}}">  
                    </div>
                    <div class="col-sm-3">
                        <label for="" class="form-label">Bulan</label>
                        <input name="bulan" type="text" class="form-control" placeholder="bulan" value="{{isset($_GET['bulan']) ? $_GET['bulan'] : ''}}">  
                    </div>
                    <div class="col-sm-3">
                        <label for="" class="form-label">Unit</label>
                        <input name="unit" type="text" class="form-control" placeholder="unit" value="{{isset($_GET['unit']) ? $_GET['unit'] : ''}}">  
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="" class="form-label">Status Pegawai</label> <br>
                            <select id="selectStatus" name="status_pegawai" class="form-control status2">
                                <option value="pns" selected="{{isset($_GET['status_pegawai']) && $_GET['status_pegawai'] == 'pns'}}">PNS</option>
                                <option value="pppk" selected="{{isset($_GET['status_pegawai']) && $_GET['status_pegawai'] == 'pppk'}}">PPPK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mt-4">Search</button>
                    </div>
                </div>
            </form>
        </div> --}}
        {{-- end filter --}}

        <div class="card-body">
            {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importModal">Import</a>
            <a href="{{route('pegawaiexport')}}" class="btn btn-warning">Export</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>OPD</th>
                            <th>Bidang/Unit Guru</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Kepala Sekolah/Pengawas</th>
                            <th>Status Pegawai</th>
                            <th>Jabatan</th>
                            <th>Status Jabatan</th>
                            <th>Kelas Jabatan</th>
                            <th>Pangkat</th>
                            <th>Eselon</th>
                            <th>JV</th>
                            <th>Indeks</th>
                            <th>TPP</th>
                            <th>Sertifikasi Guru</th>
                            <th>PA/KPA</th>
                            <th>Sertifikat Keahlian PBJ</th>
                            <th>JFT</th>
                            <th>Subkoor</th>
                            <th>Nama Subkoor</th>
                            <th>Status Subkoor</th>
                            <th>Atasan NIP</th>
                            <th>Atasan Nama</th>
                            <th>Atasannya Atasan NIP</th>
                            <th>Atasannya Atasan Nama</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @foreach ($pegbul as $item)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>{{$item->opd}}</td>
                                <td>{{$item->bidang}}</td>
                                <td>{{$item->nip}}</td>
                                <td>{{$item->nama}}</td>
                                <td>{{$item->ks}}</td>
                                <td>{{$item->sts_pegawai}}</td>
                                <td>{{$item->jabatan}}</td>
                                <td>{{$item->sts_jabatan}}</td>
                                <td>{{$item->kelas_jabatan}}</td>
                                <td>{{$item->pangkat}}</td>
                                <td>{{$item->eselon}}</td>
                                <td>{{$item->jv}}</td>
                                <td>{{$item->indeks}}</td>
                                <td>{{$item->tpp}}</td>
                                <td>{{$item->sertifikasi_guru}}</td>
                                <td>{{$item->pa_kpa}}</td>
                                <td>{{$item->pbj}}</td>
                                <td>{{$item->jft}}</td>
                                <td>{{$item->subkoor}}</td>
                                <td>{{$item->nama_subkoor}}</td>
                                <td>{{$item->sts_subkoor}}</td>
                                <td>{{$item->atasan_nip}}</td>
                                <td>{{$item->atasan_nama}}</td>
                                <td>{{$item->atasannya_atasan_nip}}</td>
                                <td>{{$item->atasannya_atasan_nama}}</td>
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
            <h6>jumlah pegawai bulanan :{{$jumlah_pegbul}}</h6>
            {!!$pegbul->render()!!}
        </div>
        <div class="modal fade" id="importpegbulModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data Pegawai Bulanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('pegbulimportexcel')}}" method="post" enctype="multipart/form-data">
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