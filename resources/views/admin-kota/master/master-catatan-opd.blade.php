@extends('admin-opd.template.default')
@section('title', 'History Catatan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">History Catatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminopd-catatan') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="pencarian" class="form-control " placeholder="Masukkan data yang dicari . . ." value="{{ $pencarian ?? '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-search fa-sm"></i> Pencarian
                            </button>
                        </div>
                    </div>
                </form></br>

                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead style="color: black; background-color: #ffe4a0;">
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>OPD</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                @if(\App\Models\lock::data() != '1')
                                    <th>Aksi</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i=0; @endphp
                            @foreach($catatans as $catatan)
                            @php $i++; $no = ($catatans->currentPage() - 1) * ($catatans->perPage()) + $i; @endphp
                            <tr>
                                <td width="1%">{{ $no }}</td>
                                <td width="5%">{{ $catatan->tahun }}</td>
                                <td width="22%">{{ $catatan->nama_opd }}</td>
                                <td width="8%">{{ $catatan->nip }}</td>
                                <td width="16%">{{ $catatan->nama_pegawai }}</td>
                                <td width="30%">
                                    <b>Catatan OPD : </b>{{ $catatan->catatan_opd }}</br>
                                    @if(!empty($catatan->catatan_admin)) <b>Catatan Admin : </b>{{ $catatan->catatan_admin }} @endif
                                </td>
                                <td width="5%">{{ $catatan->status }}</td>
                                @if(\App\Models\lock::data() != '1')
                                    <td width="14%">
                                        @if(!empty($catatan->status))
                                            
                                        @else
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalCatatan{{ $i }}"><i class="fa fa-edit"></i> Ubah</button>
                                            <a href="{{ route('adminopd-catatan.destroy', $catatan->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i> Hapus</a>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                                <div class="modal fade" id="modalCatatan{{ $i }}" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Catatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminopd-catatan.update', $catatan->id) }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="catatan_admin">Catatan</label>
                                                        <textarea name="catatan_admin" id="catatan_admin" cols="30" rows="7" class="form-control" placeholder="Masukkan catatan . . .">{{ $catatan->catatan_opd }}</textarea>
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
                <div class="text-center">
                    <span style="float:right">
                    {{ $catatans->appends([ 'pencarian' => $pencarian ])->links() }}</span>
                </div>
            </div>

            <div class="modal fade" id="createModalIndeks" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master indeks</h5>
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
