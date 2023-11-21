@extends('admin-kota.template.default')
@section('title', 'Data Pegawai')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Data Pegawai Tahun {{ session()->get('tahun_session') }} <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalPegawai" style="float:right">Tambah Data</a></h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminkota-pegawai') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama atau nip Pegawai . . ." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                        <div class="input-group-append">
                            <a href="{{ route('adminkota-pegawai') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#createFilteropdPegawai" type="button">filter OPD</button>
                        </div>
                    </div>
                </form>

                <div class="modal fade" id="createFilteropdPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Filter Data Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('adminkota-pegawai') }}" method="GET" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="filteropd">OPD</label>
                                        <select type="text" name="filteropd" class="form-control @error('filteropd') is-invalid @enderror">
                                            @foreach(\App\Models\Opd::data() as $opd)
                                                <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                            @endforeach
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <tr>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="4" checked> OPD</label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="5" checked> Jabatan Murni </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="6"> Jabatan Subkoor/Koor</label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="7" checked> Jabatan Murni </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="8"> Jenis Jabatan Subkoor/Koor </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="9" checked> Jenis Jabatan Murni</label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="10" checked> Jenis Jabatan Subkoor/Koor</label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="11" checked> Status Jabatan </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="12" checked> Nilai Jabatan </label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="13" checked> Kelas Jabatan </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="14" checked> Indeks </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="15" checked> Pangkat </label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="16" checked> Golongan PPPK </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="17" checked> Eselon </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="18" checked> Status Penerima TPP </label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="19" checked> Sertifiaksi Guru </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="20" checked> PA/KPA</label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="21" checked> Sertifikasi PBJ </label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="22" checked> Tipe Jabatan </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="23" checked> Subkoor / Koordinator </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="24" checked> Nama Subkoor / Koordinator </label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="25" checked> Status Subkoor / Koordinator </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="26" checked> Batas Usia Pensiun </label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="27" checked> Jumlah Bulan Penerimaan BK </label></br>
                            </td>
                            <td>
                                <label><input type="checkbox" class="toggle-column" data-column="28" checked> Jumlah Bulan Penerimaan PK</label></br>
                                <label><input type="checkbox" class="toggle-column" data-column="29" checked> TPP Tambahan</label></br>
                            </td>
                        </tr>
                    </table>
                    <form action="{{ route('adminkota-pegawai') }}" method="GET" class="form-inline">
                        <label for="recordsPerPage" class="mr-2">Show:</label>
                        <select name="recordsPerPage" id="recordsPerPage" class="form-control mr-2" onchange="this.form.submit()">
                            <option value="10" {{ request('recordsPerPage', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('recordsPerPage', 10) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('recordsPerPage', 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('recordsPerPage', 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                    <table class="table table-hover table-bordered" id="data-table">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="3%">NIP</th>
                                <th width="3%">Nama Pegawai</th>
                                <th width="3%">Status Pegawai</th>
                                <th width="3%">OPD</th>
                                {{-- <th width="3%">Sub OPD</th> --}}
                                <th width="15%">Jabatan Murni</th>
                                <th width="15%">Jabatan Subkoor/Koor</th>
                                <th width="3%">Jenis Jabatan Murni</th>
                                <th width="3%">Jenis Jabatan Subkoor/Koor</th>
                                <th width="3%">Status Jabatan</th>
                                <th width="3%">Nilai Jabatan (JV)</th>
                                <th width="3%">Kelas Jabatan</th>
                                <th width="3%">Indeks</th>
                                <th width="3%">Pangkat</th>
                                <th width="3%">Golongan PPPK</th>
                                <th width="3%">Eselon</th>
                                <th width="3%">Status Penerimaan TPP</th>
                                <th width="3%">Sertifikasi Guru</th>
                                <th width="3%">PA/KPA</th>
                                <th width="3%">Sertifikasi PBJ</th>
                                <th width="3%">Tipe Jabatan</th>
                                <th width="3%">Subkoor / Koordinator</th>
                                <th width="3%">Nama Subkoor / Koordinator</th>
                                <th width="3%">Status Subkoor / Koordinator</th>
                                {{-- <th width="3%">Nip Penilai / Atasan Langsung</th> --}}
                                {{-- <th width="3%">Nama Penilai / Atasan Langsung</th> --}}
                                {{-- <th width="3%">Nip Atasan Penilai</th> --}}
                                {{-- <th width="3%">Nama Atasan Penilai</th> --}}
                                <th width="3%">Batas Usia Pensiun</th>
                                <th width="3%">Jumlah Bulan Penerimaan BK</th>
                                <th width="3%">Jumlah Bulan Penerimaan PK</th>
                                <th width="3%">Tpp Tambahan</th>
                                <th width="6%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i = 0; @endphp
                            @foreach ($datas as $data)
                            @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->nama_pegawai }}</td>
                                    <td>{{ $data->sts_pegawai }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    {{-- <td>
                                        @if ($data->subopd_id == null)
                                            {{ "-" }}
                                        @else
                                            {{ $data->nama_sub_opd }}
                                        @endif
                                    </td> --}}
                                    <td>{{ $data->nama_jabatan }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' || $data->subkoor == 'Koor')
                                            {{ $data->nama_subkoor }}
                                        @else
                                            {{ $data->nama_jabatan }}
                                        @endif
                                    </td>
                                    <td>{{ $data->jenis_jabatan }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->jenis_subkor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->jenis_subkor_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->jenis_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->jenis_koor_penyetaraan }}
                                        @else
                                            {{ $data->jenis_jabatan }}
                                        @endif
                                    </td>
                                    <td>{{ $data->sts_jabatan }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_subkor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_subkor_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_koor_penyetaraan }}
                                        @else
                                            {{ $data->nilai_jabatan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->kelas_jabatan_subkor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->kelas_jabatan_subkor_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->kelas_jabatan_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->kelas_jabatan_koor_penyetaraan }}
                                        @else
                                            {{ $data->kelas_jabatan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->indeks_subkor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->indeks_subkor_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->indeks_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->indeks_koor_penyetaraan }}
                                        @else
                                            {{ $data->indeks }}
                                        @endif
                                    </td>
                                    <td>{{ $data->pangkat }}</td> 
                                    <td>{{ $data->golongan }}</td>
                                    <td>{{ $data->eselon }}</td>
                                    <td>{{ $data->tpp }}</td>
                                    <td>{{ $data->sertifikasi_guru }}</td>
                                    <td>{{ $data->pa_kpa }}</td>
                                    <td>{{ $data->pbj }}</td>
                                    <td>{{ $data->jft }}</td>
                                    <td>{{ $data->subkoor }}</td>
                                    <td>{{ $data->nama_subkoor }}</td>
                                    <td>{{ $data->sts_subkoor }}</td>
                                    {{-- <td>{{ $data->atasan_nip }}</td>
                                    <td>{{ $data->atasan_nama }}</td>
                                    <td>{{ $data->atasannya_atasan_nip }}</td>
                                    <td>{{ $data->atasannya_atasan_nama }}</td> --}}
                                    <td>{{ $data->pensiun }}</td>
                                    <td align="center">{{ $data->bulan_bk }}</td>
                                    <td align="center">{{ $data->bulan_pk }}</td>
                                    <td>{{ $data->tpp_tambahan }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ubahModalPegawai{{ $i }}"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-sm btn-danger" id="deleteButton{{ $i }}" data-toggle="modal" data-target="#hapusModalPegawai{{ $i }}"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>


                                {{-- MODALS HAPUS --}}
                                <div class="modal fade" id="hapusModalPegawai{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="hapusModalLabel">Hapus Data Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah Anda yakin ingin menghapus data pegawai ini?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                <form action="{{ route('adminkota-pegawai.destroy', $data->id) }}" method="POST" id="deleteForm{{ $i }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- MODALS EDIT --}}
                                <div class="modal fade" id="ubahModalPegawai{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Data Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-pegawai.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" name="nip"
                                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                            placeholder="NIP . . ." value="{{ $data->nip }}">
                                                        @error('nip')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pegawai">Nama Pegawai</label>
                                                        <input type="text" name="nama_pegawai"
                                                            class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                                            placeholder="Nama Pegawai . . ." value="{{ $data->nama_pegawai }}">
                                                        @error('nama_pegawai')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_pegawai">Status Pegawai</label>
                                                        <select type="text" name="sts_pegawai" class="form-control @error('sts_pegawai') is-invalid @enderror">
                                                            <option value="PNS" @if('PNS' == $data->sts_pegawai) selected @endif>PNS</option>
                                                            <option value="CPNS" @if('CPNS' == $data->sts_pegawai) selected @endif>CPNS</option>
                                                            <option value="PPPK" @if('PPPK' == $data->sts_pegawai) selected @endif>PPPK</option>
                                                            <option value="GURU" @if('GURU' == $data->sts_pegawai) selected @endif>GURU</option>
                                                            <option value="RS" @if('RS' == $data->sts_pegawai) selected @endif>RS</option>
                                                            <option value="PENGAWAS SEKOLAH" @if('PENGAWAS SEKOLAH' == $data->sts_pegawai) selected @endif>PENGAWAS SEKOLAH</option>
                                                            <option value="KEPALA SEKOLAH" @if('KEPALA SEKOLAH' == $data->sts_pegawai) selected @endif>KEPALA SEKOLAH</option>
                                                            <option value="PENSIUN" @if('PENSIUN' == $data->sts_pegawai) selected @endif>PENSIUN</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="opd_id">OPD</label>
                                                        <select type="text" name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                                            @foreach(\App\Models\Opd::where('tahun_id', session()->get('tahun_id_session'))->orderBy('nama_opd', 'ASC')->get() as $opd)
                                                                <option value="{{ $opd->id }}" @if($opd->id == $data->opd_id) selected @endif>{{ $opd->nama_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="subopd_id">Sub OPD</label>
                                                        <select type="text" name="subopd_id" class="form-control @error('subopd_id') is-invalid @enderror">
                                                            <option value="" @if($data->subopd_id == null) selected @endif>Bukan Sub OPD</option>
                                                            
                                                            @foreach(\App\Models\Subopd::orderBy('nama_sub_opd', 'ASC')->get() as $subopd)
                                                                <option value="{{ $subopd->id }}" @if($subopd->id == $data->subopd_id) selected @endif>{{ $subopd->nama_sub_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="kode_jabatanlama">Jabatan</label>
                                                        <select type="text" name="kode_jabatanlama" class="form-control select2 @error('kode_jabatanlama') is-invalid @enderror">
                                                            @foreach(\App\Models\Jabatan::data() as $jabatan)
                                                                <option value="{{ $jabatan->id }}" @if($jabatan->id == $data->kode_jabatanlama) selected @endif>{{ $jabatan->nama_jabatan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_jabatan">Status Jabatan</label>
                                                        <select type="text" name="sts_jabatan" class="form-control @error('sts_jabatan') is-invalid @enderror">
                                                            <option value="Utama" @if('Utama' == $data->sts_jabatan) selected @endif>Utama</option>
                                                            <option value="PLT" @if('PLT' == $data->sts_jabatan) selected @endif>PLT</option>
                                                            <option value="PLH" @if('PLH' == $data->sts_jabatan) selected @endif>PLH</option>
                                                            <option value="Pengganti Sementara" @if('Pengganti Sementara' == $data->sts_jabatan) selected @endif>Pengganti Sementara</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pangkat">Pangkat</label>
                                                        <select type="text" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror">
                                                            <option value="" @if($data->pangkat === null) selected @endif>--Belum dipilih--</option>
                                                            <option value="Juru Muda - I/a" @if('Juru Muda - I/a' == $data->pangkat) selected @endif>Juru Muda - I/a</option>
                                                            <option value="Juru Muda Tk.I - I/b" @if('Juru Muda Tk.I - I/b' == $data->pangkat) selected @endif>Juru Muda Tk.I - I/b</option>
                                                            <option value="Juru Muda Tk.I - I/c" @if('Juru Muda Tk.I - I/c' == $data->pangkat) selected @endif>Juru Muda Tk.I - I/c</option>
                                                            <option value="Juru Tk.I - I/d" @if('Juru Tk.I - I/d' == $data->pangkat) selected @endif>Juru Tk.I - I/d</option>
                                                            <option value="Pengatur Muda - II/a" @if('Pengatur Muda - II/a' == $data->pangkat) selected @endif>Pengatur Muda - II/a</option>
                                                            <option value="Pengatur Muda Tk.I - II/b" @if('Pengatur Muda Tk.I - II/b' == $data->pangkat) selected @endif>Pengatur Muda Tk.I - II/b</option>
                                                            <option value="Pengatur - II/c" @if('Pengatur - II/c' == $data->pangkat) selected @endif>Pengatur - II/c</option>
                                                            <option value="Pengatu Tk.I - II/d" @if('Pengatu Tk.I - II/d' == $data->pangkat) selected @endif>Pengatu Tk.I - II/d</option>
                                                            <option value="Penata Muda - III/a" @if('Penata Muda - III/a' == $data->pangkat) selected @endif>Penata Muda - III/a</option>
                                                            <option value="Penata Muda Tk.I - III/b" @if('Penata Muda Tk.I - III/b' == $data->pangkat) selected @endif>Penata Muda Tk.I - III/b</option>
                                                            <option value="Penata - III/c" @if('Penata - III/c' == $data->pangkat) selected @endif>Penata - III/c</option>
                                                            <option value="Penata Tk.I - III/d" @if('Penata Tk.I - III/d' == $data->pangkat) selected @endif>Penata Tk.I - III/d</option>
                                                            <option value="Pembina - IV/a" @if('Pembina - IV/a' == $data->pangkat) selected @endif>Pembina - IV/a</option>
                                                            <option value="Pembina Tk.I - IV/b" @if('Pembina Tk.I - IV/b' == $data->pangkat) selected @endif>Pembina Tk.I - IV/b</option>
                                                            <option value="Pembina Utama Muda - IV/c" @if('Pembina Utama Muda - IV/c' == $data->pangkat) selected @endif>Pembina Utama Muda - IV/c</option>
                                                            <option value="Pembina Utama Madya - IV/d" @if('Pembina Utama Madya - IV/d' == $data->pangkat) selected @endif>Pembina Utama Madya - IV/d</option>
                                                            <option value="Pembina Utama - IV/e" @if('Pembina Utama - IV/e' == $data->pangkat) selected @endif>Pembina Utama - IV/e</option>
                                                            <option value="Tidak Ada Pangkat--" @if('--Tidak Ada Pangkat--' == $data->pangkat) selected @endif>--Tidak Ada Pangkat--</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="golongan">Golongan PPPK</label>
                                                        <select type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror">
                                                            <option value="" @if($data->golongan === null) selected @endif>--Belum dipilih--</option>
                                                            <option value="0" @if('0' == $data->golongan) selected @endif>0</option>
                                                            <option value="I" @if('I' == $data->golongan) selected @endif>I</option>
                                                            <option value="II" @if('II' == $data->golongan) selected @endif>II</option>
                                                            <option value="III" @if('III' == $data->golongan) selected @endif>III</option>
                                                            <option value="IV" @if('IV' == $data->golongan) selected @endif>IV</option>
                                                            <option value="V" @if('V' == $data->golongan) selected @endif>V</option>
                                                            <option value="VI" @if('VI' == $data->golongan) selected @endif>VI</option>
                                                            <option value="VII" @if('VII' == $data->golongan) selected @endif>VII</option>
                                                            <option value="VIII" @if('VIII' == $data->golongan) selected @endif>VIII</option>
                                                            <option value="IX" @if('IX' == $data->golongan) selected @endif>IX</option>
                                                            <option value="X" @if('X' == $data->golongan) selected @endif>X</option>
                                                            <option value="XI" @if('XI' == $data->golongan) selected @endif>XI</option>
                                                            <option value="XII" @if('XII' == $data->golongan) selected @endif>XII</option>
                                                            <option value="XIII" @if('XIII' == $data->golongan) selected @endif>XIII</option>
                                                            <option value="XIV" @if('XIV' == $data->golongan) selected @endif>XIV</option>
                                                            <option value="XV" @if('XV' == $data->golongan) selected @endif>XV</option>
                                                            <option value="XVI" @if('XVI' == $data->golongan) selected @endif>XVI</option>
                                                            <option value="XVII" @if('XVII' == $data->golongan) selected @endif>XVII</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eselon">Eselon</label>
                                                        <select type="text" name="eselon" class="form-control @error('eselon') is-invalid @enderror">
                                                            <option value="NON ESELON" @if('NON ESELON' == $data->eselon) selected @endif>NON ESELON</option>
                                                            <option value="II.a" @if('II.a' == $data->sts_pegawai) selected @endif>II.a</option>
                                                            <option value="II.b" @if('II.b' == $data->sts_pegawai) selected @endif>II.b</option>
                                                            <option value="III.a" @if('III.a' == $data->sts_pegawai) selected @endif>III.a</option>
                                                            <option value="III.b" @if('III.b' == $data->sts_pegawai) selected @endif>III.b</option>
                                                            <option value="IV.a" @if('IV.a' == $data->sts_pegawai) selected @endif>IV.a</option>
                                                            <option value="IV.b" @if('IV.b' == $data->sts_pegawai) selected @endif>IV.b</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tpp">Status Penerima TPP</label>
                                                        <select type="text" name="tpp" class="form-control @error('tpp') is-invalid @enderror">
                                                            <option value="Penerima TPP" @if('Penerima TPP' == $data->tpp) selected @endif>Penerima TPP</option>
                                                            <option value="Bukan Penerima TPP" @if('Bukan Penerima TPP' == $data->tpp) selected @endif>Bukan Penerima TPP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sertifikasi_guru">Sertifikasi Guru</label>
                                                        <select type="text" name="sertifikasi_guru" class="form-control @error('sertifikasi_guru') is-invalid @enderror">
                                                            <option value="" @if(null === $data->sertifikasi_guru) selected @endif>Belum dipilih</option>
                                                            <option value="Sudah Sertifikasi" @if('Sudah Sertifikasi' === $data->sertifikasi_guru) selected @endif>Sudah Sertifikasi</option>
                                                            <option value="Belum Sertifikasi" @if('Belum Sertifikasi' === $data->sertifikasi_guru) selected @endif>Belum Sertifikasi</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pa_kpa">PA/KPA</label>
                                                        <select type="text" name="pa_kpa" class="form-control @error('pa_kpa') is-invalid @enderror">
                                                            <option value="" @if(null === $data->pa_kpa) selected @endif>--Belum dipilih--</option>
                                                            <option value="PA/KPA" @if('PA/KPA' === $data->pa_kpa) selected @endif>PA/KPA</option>
                                                            <option value="Bukan PA/KPA" @if('Bukan PA/KPA' === $data->pa_kpa) selected @endif>Bukan PA/KPA</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="pbj">Sertifikasi PBJ</label>
                                                        <select type="text" name="pbj" class="form-control @error('pbj') is-invalid @enderror">
                                                            <option value="" @if(null === $data->pbj) selected @endif>--Tidak dipilih--</option>
                                                            <option value="Sudah Memiliki Sertifikat" @if('Sudah Memiliki Sertifikat' === $data->pbj) selected @endif>Sudah Memiliki Sertifikat</option>
                                                            <option value="Belum Sertifikasi" @if('Belum Memiliki Sertifikat' === $data->pbj) selected @endif>Belum Memiliki Sertifikat</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jft">Tipe Jabatan</label>
                                                        <select type="text" name="jft" class="form-control @error('jft') is-invalid @enderror">
                                                            <option value="Jabatan Fungsional" @if('Jabatan Fungsional' === $data->jft) selected @endif>Jabatan Fungsional</option>
                                                            <option value="Jabatan Fungsional (Belum Diangkat)" @if('Jabatan Fungsional (Belum Diangkat)' === $data->jft) selected @endif>Jabatan Fungsional (Belum Diangkat)</option>
                                                            <option value="Jabatan Administratif" @if('Jabatan Administratif' === $data->jft) selected @endif>Jabatan Administratif</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subkoor">Subkoor / Koord</label>
                                                        <select type="text" name="subkoor" class="form-control @error('subkoor') is-invalid @enderror">
                                                            <option value="">--- Pilih Subkoor / Koord ---</option>
                                                            <option value="Bukan Subkoor / Koord">Bukan Subkoor / Koord</option>
                                                            <option value="Subkoor" @if('Subkoor' == $data->subkoor) selected @endif>Subkoor</option>
                                                            <option value="Koor" @if('Koor' == $data->subkoor) selected @endif>Koor</option>
                                                        </select>
                                                        @error('subkoor')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_subkoor">Nama Subkoor</label>
                                                        <input type="text" name="nama_subkoor"
                                                            class="form-control @error('nama_subkoor') is-invalid @enderror" id="nama_subkoor"
                                                            placeholder="Nama Subkoor . . ." value="{{ $data->nama_subkoor }}">
                                                        @error('nama_subkoor')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                     <div class="form-group">
                                                        <label for="nama_opd">Status Subkoor / Koord</label>
                                                        <select type="text" name="sts_subkoor" class="form-control @error('sts_subkoor') is-invalid @enderror">
                                                            <option value="">--- Pilih Status ---</option>
                                                            <option value="Subkoordinator Bukan Hasil Penyetaraan" @if('Subkoordinator Bukan Hasil Penyetaraan' == $data->sts_subkoor) selected @endif>Subkoordinator Bukan Hasil Penyetaraan</option>
                                                            <option value="Subkoordinator Hasil Penyetaraan" @if('Subkoordinator Hasil Penyetaraan' == $data->sts_subkoor) selected @endif>Subkoordinator Hasil Penyetaraan</option>
                                                            <option value="Koordinator Bukan Hasil Penyetaraan" @if('Koordinator Bukan Hasil Penyetaraan' == $data->sts_subkoor) selected @endif>Koordinator Bukan Hasil Penyetaraan</option>
                                                            <option value="Koordinator Hasil Penyetaraan" @if('Koordinator Hasil Penyetaraan' == $data->sts_subkoor) selected @endif>Koordinator Hasil Penyetaraan</option>
                                                        </select>
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                    {{--
                                                     <div class="form-group">
                                                        <label for="nama_opd">Nip Atasan Langsung</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                     <div class="form-group">
                                                        <label for="nama_opd">Nama Atasan Langsung</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                     <div class="form-group">
                                                        <label for="nama_opd">Nip Atasan Penilai</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Nama Atasan Penilai</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="pensiun">Batas Usia Pensiun</label>
                                                        <select type="text" name="pensiun" class="form-control @error('pensiun') is-invalid @enderror">
                                                            <option value="58" @if('58' == $data->pensiun) selected @endif>58</option>
                                                            <option value="60" @if('60' == $data->pensiun) selected @endif>60</option>
                                                            <option value="65" @if('65' == $data->pensiun) selected @endif>65</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bulan_bk">Jumlah Bulan Penerimaan BK</label>
                                                        <input type="text" name="bulan_bk"
                                                            class="form-control @error('bulan_bk') is-invalid @enderror" id="bulan_bk"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="{{ $data->bulan_bk }}">
                                                        @error('bulan_bk')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div><div class="form-group">
                                                        <label for="bulan_pk">Jumlah Bulan Penerimaan PK</label>
                                                        <input type="text" name="bulan_pk"
                                                            class="form-control @error('bulan_pk') is-invalid @enderror" id="bulan_pk"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="{{ $data->bulan_pk }}">
                                                        @error('bulan_pk')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tpp_tambahan">Tpp Tambahan</label>
                                                        <input type="text" name="tpp_tambahan"
                                                            class="form-control @error('tpp_tambahan') is-invalid @enderror" id="tpp_tambahan"
                                                            placeholder="Tpp Tambahan . . ." value="{{ $data->tpp_tambahan }}">
                                                        @error('tpp_tambahan')
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

                                {{-- MODALS CREATE --}}
                                <div class="modal fade" id="createModalPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Tambah Data Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-pegawai.store') }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" name="nip"
                                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                            placeholder="NIP . . ." value="">
                                                        @error('nip')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pegawai">Nama Pegawai</label>
                                                        <input type="text" name="nama_pegawai"
                                                            class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                                            placeholder="Nama Pegawai . . ." value="">
                                                        @error('nama_pegawai')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_pegawai">Status Pegawai</label>
                                                        <select type="text" name="sts_pegawai" class="form-control @error('sts_pegawai') is-invalid @enderror">
                                                            <option value="PNS" >PNS</option>
                                                            <option value="CPNS" >CPNS</option>
                                                            <option value="PPPK" >PPPK</option>
                                                            <option value="GURU" >GURU</option>
                                                            <option value="RS" >RS</option>
                                                            <option value="PENGAWAS SEKOLAH" >PENGAWAS SEKOLAH</option>
                                                            <option value="KEPALA SEKOLAH" >KEPALA SEKOLAH</option>
                                                            <option value="PENSIUN" >PENSIUN</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="opd_id">OPD</label>
                                                        <select type="text" name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                                            @foreach(\App\Models\Opd::where('tahun_id', session()->get('tahun_id_session'))->orderBy('nama_opd', 'ASC')->get() as $opd)
                                                                <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="form-group">
                                                        <label for="subopd_id">Sub OPD</label>
                                                        <select type="text" name="subopd_id" class="form-control @error('subopd_id') is-invalid @enderror">
                                                            @foreach(\App\Models\Subopd::orderBy('nama_sub_opd', 'ASC')->get() as $subopd)
                                                                <option value="" disabled>--Belum Dipilih--</option>
                                                                <option value="{{ $subopd->id }}">{{ $opd->nama_sub_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                    <div class="form-group">
                                                        <label for="kode_jabatanlama">Jabatan</label>
                                                        <select type="text" name="kode_jabatanlama" class="form-control select2 @error('kode_jabatanlama') is-invalid @enderror">
                                                            <option value="">--- Pilih Jabatan ---</option>
                                                            @foreach(\App\Models\Jabatan::data() as $jabatan)
                                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_jabatan">Status Jabatan</label>
                                                        <select type="text" name="sts_jabatan" class="form-control @error('sts_jabatan') is-invalid @enderror">
                                                            <option value="Utama" >Utama</option>
                                                            <option value="PLT" >PLT</option>
                                                            <option value="PLH" >PLH</option>
                                                            <option value="Pengganti Sementara" >Pengganti Sementara</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subkoor">Subkoor / Koord</label>
                                                        <select type="text" name="subkoor" class="form-control @error('subkoor') is-invalid @enderror">
                                                            <option value="">--- Pilih Subkoor / Koord ---</option>
                                                            <option value="Bukan Subkoor / Koord">Bukan Subkoor / Koord</option>
                                                            <option value="Subkoor">Subkoor</option>
                                                            <option value="Koor">Koor</option>
                                                        </select>
                                                        @error('subkoor')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_subkoor">Nama Subkoor</label>
                                                        <input type="text" name="nama_subkoor"
                                                            class="form-control @error('nama_subkoor') is-invalid @enderror" id="nama_subkoor"
                                                            placeholder="Nama Subkoor . . ." value="">
                                                        @error('nama_subkoor')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                        <div class="form-group">
                                                        <label for="nama_opd">Status Subkoor / Koord</label>
                                                        <select type="text" name="sts_subkoor" class="form-control @error('sts_subkoor') is-invalid @enderror">
                                                            <option value="">--- Pilih Status ---</option>
                                                            <option value="Subkoordinator Bukan Hasil Penyetaraan">Subkoordinator Bukan Hasil Penyetaraan</option>
                                                            <option value="Subkoordinator Hasil Penyetaraan">Subkoordinator Hasil Penyetaraan</option>
                                                            <option value="Koordinator Bukan Hasil Penyetaraan">Koordinator Bukan Hasil Penyetaraan</option>
                                                            <option value="Koordinator Hasil Penyetaraan">Koordinator Hasil Penyetaraan</option>
                                                        </select>
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="pangkat">Pangkat</label>
                                                        <select type="text" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror">
                                                            <option value="Juru Muda - I/a">Juru Muda - I/a</option>
                                                            <option value="Juru Muda Tk.I - I/b">Juru Muda Tk.I - I/b</option>
                                                            <option value="Juru Muda Tk.I - I/c">Juru Muda Tk.I - I/c</option>
                                                            <option value="Juru Tk.I - I/d">Juru Tk.I - I/d</option>
                                                            <option value="Pengatur Muda - II/a">Pengatur Muda - II/a</option>
                                                            <option value="Pengatur Muda Tk.I - II/b">Pengatur Muda Tk.I - II/b</option>
                                                            <option value="Pengatur - II/c">Pengatur - II/c</option>
                                                            <option value="Pengatu Tk.I - II/d">Pengatu Tk.I - II/d</option>
                                                            <option value="Penata Muda - III/a">Penata Muda - III/a</option>
                                                            <option value="Penata Muda Tk.I - III/b">Penata Muda Tk.I - III/b</option>
                                                            <option value="Penata - III/c">Penata - III/c</option>
                                                            <option value="Penata Tk.I - III/d">Penata Tk.I - III/d</option>
                                                            <option value="Pembina - IV/a">Pembina - IV/a</option>
                                                            <option value="Pembina Tk.I - IV/b">Pembina Tk.I - IV/b</option>
                                                            <option value="Pembina Utama Muda - IV/c">Pembina Utama Muda - IV/c</option>
                                                            <option value="Pembina Utama Madya - IV/d">Pembina Utama Madya - IV/d</option>
                                                            <option value="Pembina Utama - IV/e">Pembina Utama - IV/e</option>
                                                            <option value="Tidak Ada Pangkat--">--Tidak Ada Pangkat--</option>
                                                        </select>
                                                        @error('pangkat')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="golongan">Golongan</label>
                                                        <select type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror">
                                                            <option value="0">0</option>
                                                            <option value="I">I</option>
                                                            <option value="II">II</option>
                                                            <option value="III">III</option>
                                                            <option value="IV">IV</option>
                                                            <option value="V">V</option>
                                                            <option value="VI">VI</option>
                                                            <option value="VII">VII</option>
                                                            <option value="VIII">VIII</option>
                                                            <option value="IX">IX</option>
                                                            <option value="X">X</option>
                                                            <option value="XI">XI</option>
                                                            <option value="XII">XII</option>
                                                            <option value="XIII">XIII</option>
                                                            <option value="XIV">XIV</option>
                                                            <option value="XV">XV</option>
                                                            <option value="XVI">XVI</option>
                                                            <option value="XVII">XVII</option>
                                                        </select>
                                                        @error('golongan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eselon">Eselon</label>
                                                        <select type="text" name="eselon" class="form-control @error('eselon') is-invalid @enderror">
                                                            <option value="NON ESELON">NON ESELON</option>
                                                            <option value="II.a">II.a</option>
                                                            <option value="II.b">II.b</option>
                                                            <option value="III.a">III.a</option>
                                                            <option value="III.b">III.b</option>
                                                            <option value="IV.a">IV.a</option>
                                                            <option value="IV.b">IV.b</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tpp">Status Penerima TPP</label>
                                                        <select type="text" name="tpp" class="form-control @error('tpp') is-invalid @enderror">
                                                            <option value="Penerima TPP">Penerima TPP</option>
                                                            <option value="Bukan Penerima TPP">Bukan Penerima TPP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sertifikasi_guru">Sertifikasi Guru</label>
                                                        <select type="text" name="sertifikasi_guru" class="form-control @error('sertifikasi_guru') is-invalid @enderror">
                                                            <option value="" >Belum dipilih</option>
                                                            <option value="Sudah Sertifikasi">Sudah Sertifikasi</option>
                                                            <option value="Belum Sertifikasi">Belum Sertifikasi</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pa_kpa">PA/KPA</label>
                                                        <select type="text" name="pa_kpa" class="form-control @error('pa_kpa') is-invalid @enderror">
                                                            <option value="">--Belum dipilih--</option>
                                                            <option value="PA/KPA">PA/KPA</option>
                                                            <option value="Bukan PA/KPA" >Bukan PA/KPA</option>
                                                        </select>
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="pbj">Sertifikasi PBJ</label>
                                                        <select type="text" name="pbj" class="form-control @error('pbj') is-invalid @enderror">
                                                            <option value="" >--Tidak dipilih--</option>
                                                            <option value="Sudah Memiliki Sertifikat" >Sudah Memiliki Sertifikat</option>
                                                            <option value="Belum Sertifikasi" >Belum Memiliki Sertifikat</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="jft">Tipe Jabatan</label>
                                                        <select type="text" name="jft" class="form-control @error('jft') is-invalid @enderror">
                                                            <option value="Jabatan Fungsional" >Jabatan Fungsional</option>
                                                            <option value="Jabatan Fungsional (Belum Diangkat)">Jabatan Fungsional (Belum Diangkat)</option>
                                                            <option value="Jabatan Administratif">Jabatan Administratif</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pensiun">Batas Usia Pensiun</label>
                                                        <select type="text" name="pensiun" class="form-control @error('pensiun') is-invalid @enderror">
                                                            <option value="58" >58</option>
                                                            <option value="60" >60</option>
                                                            <option value="65" >65</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bulan_bk">Jumlah Bulan Penerimaan BK</label>
                                                        <input type="text" name="bulan_bk"
                                                            class="form-control @error('bulan_bk') is-invalid @enderror" id="bulan_bk"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="">
                                                        @error('bulan_bk')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bulan_pk">Jumlah Bulan Penerimaan BK</label>
                                                        <input type="text" name="bulan_pk"
                                                            class="form-control @error('bulan_pk') is-invalid @enderror" id="bulan_pk"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="">
                                                        @error('bulan_pk')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tpp_tambahan">Tpp Tambahan</label>
                                                        <input type="text" name="tpp_tambahan"
                                                            class="form-control @error('tpp_tambahan') is-invalid @enderror" id="tpp_tambahan"
                                                            placeholder="Tpp Tambahan . . ." value="">
                                                        @error('tpp_tambahan')
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
                        <div class="text-center">
                            {{ $datas->appends([ 
                                'pencarian' => $search ,
                                'pagination' => $pagination, 
                                'filteropd' => $filteropd
                                ])->links() }}</span>
                                {{-- {{ $datas->links() }} --}}
                        </div>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleColumn(columnIndex, checked) {
            const table = document.getElementById("data-table");
            const rows = table.querySelectorAll("tr");

            rows.forEach((row) => {
                const cells = row.querySelectorAll("th, td");
                if (cells.length > columnIndex) {
                    const cell = cells[columnIndex];
                    if (checked) {
                        cell.classList.remove("d-none");
                    } else {
                        cell.classList.add("d-none");
                    }
                }
            });
        }

        toggleColumn(6, false);
        toggleColumn(8, false);

        const toggleColumnCheckboxes = document.querySelectorAll(".toggle-column");

        toggleColumnCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const columnIndex = this.getAttribute("data-column");
                const isChecked = this.checked;
                toggleColumn(columnIndex, isChecked);
            });
        });

        const toggleRowCheckboxes = document.querySelectorAll(".toggle-row");

        toggleRowCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const row = this.parentNode.parentNode;
                const rowColumns = row.querySelectorAll("th, td");
                const isChecked = this.checked;

                rowColumns.forEach((cell, index) => {
                    if (index > 0) {
                        if (isChecked) {
                            cell.classList.remove("d-none");
                        } else {
                            cell.classList.add("d-none");
                        }
                    }
                });
            });
        });
    </script>
    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>
    @endpush
    
@endsection
