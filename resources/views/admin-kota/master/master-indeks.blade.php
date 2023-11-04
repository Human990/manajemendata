@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master Indeks {{ session()->get('tahun_session') }}</h3>
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
                                <th width="15%">Tahun</th>
                                <th width="30%">Jenis Jabatan</th>
                                <th width="30%">Kelas</th>
                                <th width="15%">Indeks</th>
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
                                    <td>{{ $data->jenis_jabatan_baru }}</td>
                                    <td>{{ $data->kelas_jabatan }}</td>
                                    <td>{{ $data->indeks}}</td>
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
                                                <h5 class="modal-title" id="createModalLabel">Ubah Master Tahun</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-indeks.update', $data->kode_indeks) }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="jenis_jabatan">Jenis Jabatan</label>
                                                        <select name="jenis_jabatan" id="jenis_jabatan" class="form-control">
                                                            @foreach(\App\Models\Jenis_jabatan::orderBy('id', 'ASC')->get() as $jenis)
                                                                <option value="{{ $jenis->id }}" @if($jenis->id == (int)$data->jenis_jabatan) selecter @endif>{{ $jenis->jenis_jabatan }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('jenis_jabatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kelas_jabatan">Kelas Jabatan</label>
                                                        <input type="number" name="kelas_jabatan"
                                                            class="form-control @error('kelas_jabatan') is-invalid @enderror" id="kelas_jabatan"
                                                            placeholder="Kelas Jabatan . . ." value="{{ $data->kelas_jabatan }}">
                                                        @error('kelas_jabatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="indeks">Indeks</label>
                                                        <input type="text" name="indeks"
                                                            class="form-control @error('indeks') is-invalid @enderror" id="indeks"
                                                            placeholder="Indeks . . ." value="{{ $data->indeks }}">
                                                        @error('indeks')
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
                            <h5 class="modal-title" id="createModalLabel">Tambah Master Tahun</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-indeks.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                <div class="form-group">
                                    <label for="jenis_jabatan">Jenis Jabatan</label>
                                    <select name="jenis_jabatan" id="jenis_jabatan" class="form-control">
                                        @foreach(\App\Models\Jenis_jabatan::orderBy('id', 'ASC')->get() as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->jenis_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kelas_jabatan">Kelas Jabatan</label>
                                    <input type="number" name="kelas_jabatan"
                                        class="form-control @error('kelas_jabatan') is-invalid @enderror" id="kelas_jabatan"
                                        placeholder="Kelas Jabatan . . ." value="{{ old('kelas_jabatan') }}">
                                    @error('kelas_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks">Indeks</label>
                                    <input type="text" name="indeks"
                                        class="form-control @error('indeks') is-invalid @enderror" id="indeks"
                                        placeholder="Indeks . . ." value="{{ old('indeks') }}">
                                    @error('indeks')
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
