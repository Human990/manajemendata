@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">History Catatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminkota-catatan') }}" method="GET">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i=0; @endphp
                            @foreach($catatans as $catatan)
                            @php $i++; $no = ($catatans->currentPage() - 1) * ($catatans->perPage()) + $i; @endphp
                            <tr>
                                <td width="1%">{{ $no }}</td>
                                <td width="5%">{{ $catatan->tahun }}</td>
                                <td width="20%">{{ $catatan->nama_opd }}</td>
                                <td width="8%">{{ $catatan->nip }}</td>
                                <td width="16%">{{ $catatan->nama_pegawai }}</td>
                                <td width="32%">
                                    <b>Catatan OPD : </b>{{ $catatan->catatan_opd }}</br>
                                    @if(!empty($catatan->catatan_admin)) <b>Catatan Admin : </b>{{ $catatan->catatan_admin }} @endif
                                </td>
                                <td width="5%">{{ $catatan->status }}</td>
                                <td width="14%">
                                    @if(!empty($catatan->status))
                                        
                                    @else
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalPegawai{{ $i }}"><i class="fa fa-edit"></i> Pegawai</button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalCatatan{{ $i }}"><i class="fa fa-plus"></i> Catatan</button>
                                    @endif
                                </td>
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
                                            <form action="{{ route('adminkota-catatan.update', $catatan->id) }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="catatan_admin">Catatan Admin Kota</label>
                                                        <textarea name="catatan_admin" id="catatan_admin" cols="30" rows="7" class="form-control" placeholder="Masukkan catatan . . .">{{ $catatan->catatan_admin }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="Selesai">Selesai</option>
                                                            <option value="Ditolak">Ditolak</option>
                                                        </select>
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

                                <div class="modal fade" id="modalPegawai{{ $i }}" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Data Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-pegawai.update', $catatan->pegawai_id) }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="kode_opd">OPD</label>
                                                        <select name="opd_id" id="opd_id" class="form-control">
                                                            @foreach(\App\Models\Opd::orderBy('nama_opd', 'ASC')->get() as $opd)
                                                                <option value="{{ $opd->id }}" @if($catatan->opd_id == $opd->id) selected @endif>{{ $opd->nama_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" name="nip"
                                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                            placeholder="NIP . . ." value="{{ $catatan->nip }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pegawai">Nama Pegawai</label>
                                                        <input type="text" name="nama_pegawai"
                                                            class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                                            placeholder="Nama Pegawai . . ." value="{{ $catatan->nama_pegawai }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pangkat">Pangkat</label>
                                                        <input type="text" name="pangkat"
                                                            class="form-control @error('pangkat') is-invalid @enderror" id="pangkat"
                                                            placeholder="Pangkat . . ." value="{{ $catatan->pangkat }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="golongan">Golongan</label>
                                                        <input type="text" name="golongan"
                                                            class="form-control @error('golongan') is-invalid @enderror" id="golongan"
                                                            placeholder="Golongan . . ." value="{{ $catatan->golongan }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eselon">Eselon</label>
                                                        <input type="text" name="eselon"
                                                            class="form-control @error('eselon') is-invalid @enderror" id="eselon"
                                                            placeholder="Eselon . . ." value="{{ $catatan->eselon }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="total_bulan_penerimaan">Jumlah Bulan Penerimaan</label>
                                                        <input type="number" name="total_bulan_penerimaan"
                                                            class="form-control @error('total_bulan_penerimaan') is-invalid @enderror" id="total_bulan_penerimaan"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="{{ $catatan->total_bulan_penerimaan }}">
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
