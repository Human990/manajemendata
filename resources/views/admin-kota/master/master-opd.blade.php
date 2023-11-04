@extends('admin-kota.template.default')
@section('title', 'Master OPD')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master OPD Tahun {{ session()->get('tahun_session') }}</h3>
            </div>
            {{-- <div class="card-body">
            <form action="{{route('admin.searchDakep')}}" class="form-inline" method="GET">
                <input type="search" class="form-control" placeholder="Search..." aria-label="Search" name="search">
                <button class="btn btn-outline-primary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div> --}}
            {{-- <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importModal">Import</a>
            <a href="{{route('pegawaiexport')}}" class="btn btn-warning">Export</a>
        </div> --}}
            <div class="card-body">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalIndeks">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="10%">Tahun</th>
                                <th width="10%">Kode OPD</th>
                                <th width="10%">Kode Sub OPD</th>
                                <th width="60%">Nama OPD</th>
                                <th width="9%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i = 0; @endphp
                            @foreach ($datas as $data)
                            @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $data->tahun }}</td>
                                    <td>{{ $data->kode_opd }}</td>
                                    <td>{{ $data->kode_sub_opd }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks{{ $i }}"><i class="fa fa-eye"></i> Ubah</button>
                                        {{-- <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button> --}}
                                    </td>
                                </tr>

                                <div class="modal fade" id="ubahModalIndeks{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Master OPD</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-opd.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="kode_opd">Kode OPD</label>
                                                        <input type="text" name="kode_opd"
                                                            class="form-control @error('kode_opd') is-invalid @enderror" id="kode_opd"
                                                            placeholder="Kode OPD . . ." value="{{ $data->kode_opd }}">
                                                        @error('kode_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kode_sub_opd">Kode Sub OPD</label>
                                                        <input type="text" name="kode_sub_opd"
                                                            class="form-control @error('kode_sub_opd') is-invalid @enderror" id="kode_sub_opd"
                                                            placeholder="Kode Sub OPD . . ." value="{{ $data->kode_sub_opd }}">
                                                        @error('kode_sub_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Nama OPD</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
            </div>
            <div class="modal fade" id="createModalIndeks" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master OPD</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-opd.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                <div class="form-group">
                                    <label for="kode_opd">Kode OPD</label>
                                    <input type="text" name="kode_opd"
                                        class="form-control @error('kode_opd') is-invalid @enderror" id="kode_opd"
                                        placeholder="Kode OPD . . ." value="{{ old('kode_opd') }}">
                                    @error('kode_opd')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kode_sub_opd">Kode Sub OPD</label>
                                    <input type="text" name="kode_sub_opd"
                                        class="form-control @error('kode_sub_opd') is-invalid @enderror" id="kode_sub_opd"
                                        placeholder="Kode Sub OPD . . ." value="{{ old('kode_sub_opd') }}">
                                    @error('kode_sub_opd')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_opd">Nama OPD</label>
                                    <input type="text" name="nama_opd"
                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                        placeholder="Nama OPD . . ." value="{{ old('nama_opd') }}">
                                    @error('nama_opd')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
