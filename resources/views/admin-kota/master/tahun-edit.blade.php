@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Edit Master Tahun</h3>
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
            {{-- <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModal">Tambah Data</a>
        </div> --}}
            <div class="card-body">
                <form action="{{ route('adminkota-tahun.update', $tahun->id) }}" method="post" class=""
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="tahun">Tahun</label>
                            <input type="text" name="tahun" class="form-control @error('tahun') is-invalid @enderror"
                                id="tahun" placeholder="tahun" value="{{ $tahun->tahun ?? old('tahun') }}">
                            @error('tahun')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                            <p style="color: red">*wajib diisi</p>
                        </div>
                        <div class="form-group col-md-12">
                                    <label for="keterangan">Keterangan</label>
                                    <input type="text" name="keterangan"
                                        class="form-control @error('keterangan') is-invalid @enderror" id="keterangan"
                                        placeholder="keterangan" value="{{ old('keterangan') ?? $tahun->keterangan }}">
                                    @error('keterangan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                        </div>

                        <div class="form-group col-sm-6 col-md-6 mt-5">
                            <button type="submit" class="form-control btn-primary" id="tombol">Simpan</button>
                        </div>
                        <div class="form-group col-sm-6 col-md-6 mt-5">
                            <a href="{{ route('adminkota-tahun') }}" class="btn btn-warning btn-block">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
            {{-- <div class="text-center">
            {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
            {{-- {!!$rupiah->render()!!}
        </div> --}}
            {{-- <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Master Rupiah</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('rupiah.store')}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <label for="nama">Keterangan</label>
                                <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="nama" 
                                placeholder="keterangan" value="{{old('nama')}}" >
                                @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="jumlah">Jumlah</label>
                                <input type="text" name="jumlah" class="form-control @error('jumlah') is-invalid @enderror" id="jumlah" 
                                placeholder="jumlah" value="{{ old('jumlah') }}" >
                                @error('jumlah')
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
        </div> --}}
        </div>
    </div>
@endsection
