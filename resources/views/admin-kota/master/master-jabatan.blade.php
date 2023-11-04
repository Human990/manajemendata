@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master Jabatan Tahun {{ session()->get('tahun_session') }} <a href="#" style="float:right" class="btn btn-info" data-toggle="modal" data-target="#createModalIndeks">Tambah Data</a> </h3>
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
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="8%">Tahun</th>
                                <th width="36%">Nama Jabatan</th>
                                <th width="12%">Jenis Jabatan</th>
                                <th width="8%">Kelas</th>
                                <th width="8%">Nilai jabatan</th>
                                <th width="8%">Indeks</th>
                                <th width="10%">Tunjab</th>
                                <th width="9%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i=0; @endphp
                            @foreach ($datas as $data)
                            @php $i++; $no = ($datas->currentPage() - 1) * ($datas->perPage()) + $i; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $data->tahun }}</td>
                                    <td>{{ $data->nama_jabatan }}</td>
                                    <td>{{ $data->jenis_jabatan }}</td>
                                    <td>{{ $data->kelas_jabatan }}</td>
                                    <td align="right">{{ number_format((float)$data->nilai_jabatan, 0, ',', '.') }}</td>
                                    <td align="right">{{ $data->indeks }}</td>
                                    <td align="right">{{ number_format($data->tunjab, 0, ',', '.') }}</td>
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
                                                <h5 class="modal-title" id="createModalLabel">Ubah Master Jabatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-jabatan.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nama_jabatan">Nama Jabatan</label>
                                                        <input type="text" name="nama_jabatan"
                                                            class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan"
                                                            placeholder="Nama Jabatan . . ." value="{{ $data->nama_jabatan }}">
                                                        @error('nama_jabatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nilai_jabatan">Nilai Jabatan</label>
                                                        <input type="text" name="nilai_jabatan"
                                                            class="form-control @error('nilai_jabatan') is-invalid @enderror" id="nilai_jabatan"
                                                            placeholder="Nilai Jabatan . . ." value="{{ $data->nilai_jabatan }}">
                                                        @error('nilai_jabatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tunjab">Tunjangan Jabatan</label>
                                                        <input type="number" name="tunjab"
                                                            class="form-control @error('tunjab') is-invalid @enderror" id="tunjab"
                                                            placeholder="Tunjangan Jabatan . . ." value="{{ $data->tunjab }}">
                                                        @error('tunjab')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="indeks_id">Jenis Jabatan / Kelas / Indeks</label>
                                                        <select name="indeks_id" id="indeks_id" class="form-control">
                                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                                <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $data->indeks_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('indeks_id')
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
                <span style="float:right">{{ $datas->links() }}</span>
            </div>
            <div class="modal fade" id="createModalIndeks" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master Jabatan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-jabatan.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                <div class="form-group">
                                    <label for="nama_jabatan">Nama Jabatan</label>
                                    <input type="text" name="nama_jabatan"
                                        class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan"
                                        placeholder="Nama Jabatan . . ." value="{{ old('nama_jabatan') }}">
                                    @error('nama_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nilai_jabatan">Nilai Jabatan</label>
                                    <input type="text" name="nilai_jabatan"
                                        class="form-control @error('nilai_jabatan') is-invalid @enderror" id="nilai_jabatan"
                                        placeholder="Nilai Jabatan . . ." value="{{ old('nilai_jabatan') }}">
                                    @error('nilai_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tunjab">Tunjangan Jabatan</label>
                                    <input type="number" name="tunjab"
                                        class="form-control @error('tunjab') is-invalid @enderror" id="tunjab"
                                        placeholder="Tunjangan Jabatan . . ." value="{{ old('tunjab') }}">
                                    @error('tunjab')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks_id">Jenis Jabatan / Kelas / Indeks</label>
                                    <select name="indeks_id" id="indeks_id" class="form-control">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                        @endforeach
                                    </select>
                                    @error('indeks_id')
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
