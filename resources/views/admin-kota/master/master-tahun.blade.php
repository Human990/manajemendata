@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master Tahun</h3>
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
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalTahun">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%">Tahun</th>
                                <th width="69%">Keterangan</th>
                                <th width="9%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @foreach ($tahun as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td>
                                        <a href="{{ route('adminkota-tahun.edit', $item->id) }}"
                                            class="btn btn-sm btn-info btn-block"><i class="fa fa-eye"></i> Edit</a>
                                        {{-- <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
                {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
                {!! $tahun->render() !!}
            </div>
            <div class="modal fade" id="createModalTahun" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master Tahun</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-tahun.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" name="tahun"
                                        class="form-control @error('tahun') is-invalid @enderror" id="tahun"
                                        placeholder="tahun" value="{{ old('tahun') }}">
                                    @error('tahun')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan"
                                        class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                        placeholder="keterangan" value="{{ old('keterangan') }}">
                                    @error('keterangan')
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
