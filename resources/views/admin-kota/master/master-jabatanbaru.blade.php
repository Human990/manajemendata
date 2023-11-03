@extends('admin-kota.template.default')
@section('title', 'Master Jabatan Baru')
@section('master-jabatanbaru', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master Jabatan Baru</h3>
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
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalJabatanbaru">Tambah Data</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Jabatan</th>
                                <th>Nama Jabatan</th>
                                <th>Jenis Jabatan</th>
                                <th>Kelas Jabatan</th>
                                <th>Nilai Jabatan (JV)</th>
                                <th>Indeks</th>
                                <th>Tunjangan Jabatan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @foreach ($jabatanbaru as $item)
                                @php
                                    // Mengambil data indeks dari view_indeks berdasarkan jenis_jabatan dan kelas_jabatan
                                    $indeksItem = $viewIndeksData
                                        ->where('jenis_jabatan', $item->jenis_jabatan)
                                        ->where('kelas_jabatan', $item->kelas_jabatan)
                                        ->first();
                                @endphp
                                <tr>
                                    <td>{{ $item->kode_jabatanbaru }}</td>
                                    <td>{{ $item->nama_jabatan }}</td>
                                    <td>{{ $item->jenis_jabatan }}</td>
                                    <td>{{ $item->kelas_jabatan }}</td>
                                    <td>{{ $item->nilai_jabatan }}</td>
                                    <td>{{ $indeksItem->indeks ?? '' }}</td>
                                    <td>{{ $item->tunjab }}</td>
                                    <td>
                                        <a href="{{ route('adminkota-jabatanbaru-edit', ['kode_jabatanbaru' => $item->kode_jabatanbaru]) }}"
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
                {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
                {!! $jabatanbaru->links() !!}
            </div>
            <div class="modal fade" id="createModalJabatanbaru" tabindex="-1" role="dialog"
                aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master jabatan Baru</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
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
