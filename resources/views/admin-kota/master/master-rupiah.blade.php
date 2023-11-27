@extends('admin-kota.template.default')
@section('title', 'Master Rupiah')
@section('master-rupiah', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master Rupiah Tahun {{ session()->get('tahun_session') }}</h3>
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
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalRupiah">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="10%">Tahun</th>
                                <th width="44%">Keterangan</th>
                                <th width="15%">Flag</th>
                                <th width="20%">Jumlah</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        @php $i=0; @endphp
                        <tbody id="dynamic-row">
                            @foreach ($datas as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->tahun }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->flag }}</td>
                                    <td align="right">{{ number_format($item->jumlah, 2, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('adminkota-rupiah.edit', $item->id) }}"
                                            class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Edit</a>
                                        {{-- <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="text-center">
            </div>
            <div class="modal fade" id="createModalRupiah" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master Rupiah</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-rupiah.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                <div class="form-group">
                                    <label for="nama">Keterangan</label>
                                    <input type="text" name="nama"
                                        class="form-control @error('nama') is-invalid @enderror" id="nama"
                                        placeholder="keterangan" value="{{ old('nama') }}">
                                    @error('nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="text" name="jumlah"
                                        class="form-control @error('jumlah') is-invalid @enderror" id="jumlah"
                                        placeholder="jumlah" value="{{ old('jumlah') }}">
                                    @error('jumlah')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="flag">Flag</label>
                                    <input type="text" name="flag"
                                        class="form-control @error('flag') is-invalid @enderror" id="flag"
                                        placeholder="flag" value="{{ old('flag') }}">
                                    @error('flag')
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
