@extends('template.default')
@section('title','Tpp Beban Kerja')
@section('tpp-beban-kerja','active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Laporan TPP Beban Kerja Bulanan</h3>
        </div>
        <div class="card-body">
            {{-- <form action="{{route('admin.searchDakep')}}" class="form-inline" method="GET">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form> --}}
            <form action="{{route('tpp-beban-kerja')}}" method="get">
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
        </div>
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
                            <th>NAMA/NIP/GOLONGAN/JABATAN/REKENING</th>
                            <th>JUMLAH KOTOR</th>
                            <th>JUMLAH BERSIH</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @forelse ($tppbebankerja as $item)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>
                                    {{$item->nama}}, <br>
                                    {{$item->nip}}, <br>
                                    {{$item->golongan}}, <br>
                                    {{$item->jabatan}}, <br>
                                    {{$item->rekening}}
                                </td>
                                <td>{{$item->jumlah_kotor}}</td>
                                <td>{{$item->jumlah_bersih}}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Edit</a>
                                    <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No user found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
            <h6>jumlah data :{{$jumlah_data}}</h6>
            {!!$tppbebankerja->render()!!}
        </div>
        {{-- <div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
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
        </div> --}}
    </div>
</div>
@endsection