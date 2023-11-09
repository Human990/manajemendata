@extends('admin-opd.template.default')
@section('title', 'Data Pegawai')
@section('pegawai-bulanan', 'active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Data Pegawai Tahun {{ session()->get('tahun_session') }} 
                <!-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalPegawai" style="float:right">Tambah Data</a> -->
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('adminopd-pegawai') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari nama atau nip Pegawai . . ." name="search" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                    <div class="input-group-append">
                        <a href="{{ route('adminopd-pegawai') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#createFilterPegawai" type="button">filter</button>
                    </div>
                </div>
            </form>

            <div class="modal fade" id="createFilterPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Filter Data Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminopd-pegawai') }}" method="GET" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="filter">Jenis Jabatan / Kelas / Indeks</label>
                                    <select type="text" name="filter" class="form-control @error('filter') is-invalid @enderror">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
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
                            <label><input type="checkbox" class="toggle-column" data-column="5" checked> Nama Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="6" checked> Jenis Jabatan</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="7"> Status Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="8" checked> Nilai Jabatan (JV)</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="9" checked> Indeks</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="10" checked> Pangkat</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="11" checked> Golongan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="12" checked> Eselon</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="13"> Status Penerimaan TPP</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="14"> Sertifikasi Guru</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="15"> PA/KPA</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="16"> Sertifikasi PBJ</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="17"> Tipe Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="18"> Subkoor</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="19"> Nama Subkoor</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="20"> Status Subkoor</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="21"> NIP Penilai</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="22"> Nama Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="23"> Nip Atasan Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="24"> Nama Atasan Penilai</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="25" checked> Pensiun</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="26" checked> Jumlah Bulan Penerimaan BK</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="27" checked> Jumlah Bulan Penerimaan PK</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="28" checked> Tpp Tambahan</label></br>
                        </td>
                    </tr>
                </table>

                <table class="table table-hover table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="3%">NIP</th>
                            <th width="3%">Nama Pegawai</th>
                            <th width="3%">Status Pegawai</th>
                            <th width="3%">OPD</th>
                            <th width="15%">Nama Jabatan</th>
                            <th width="3%">Jenis Jabatan</th>
                            <th width="3%">Status Jabatan</th>
                            <th width="3%">Nilai Jabatan (JV)</th>
                            <th width="3%">Indeks</th>
                            <th width="3%">Pangkat</th>
                            <th width="3%">Golongan</th>
                            <th width="3%">Eselon</th>
                            <th width="3%">Status Penerimaan TPP</th>
                            <th width="3%">Sertifikasi Guru</th>
                            <th width="3%">PA/KPA</th>
                            <th width="3%">Sertifikasi PBJ</th>
                            <th width="3%">Tipe Jabatan</th>
                            <th width="3%">Subkoor</th>
                            <th width="3%">Nama Subkoor</th>
                            <th width="3%">Status Subkoor</th>
                            <th width="3%">Nip Penilai / Atasan Langsung</th>
                            <th width="3%">Nama Penilai / Atasan Langsung</th>
                            <th width="3%">Nip Atasan Penilai</th>
                            <th width="3%">Nama Atasan Penilai</th>
                            <th width="3%">Pensiun</th>
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
                                    <td>
                                        @if($data->subkoor == 'Subkoor' || $data->subkoor == 'Koor')
                                            {{ $data->nama_subkoor }}
                                        @else
                                            {{ $data->nama_jabatan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->jenis_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->jenis_penyetaraan }}
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
                                <td>{{ $data->atasan_nip }}</td>
                                <td>{{ $data->atasan_nama }}</td>
                                <td>{{ $data->atasannya_atasan_nip }}</td>
                                <td>{{ $data->atasannya_atasan_nama }}</td>
                                <td>{{ $data->pensiun }}</td>
                                <td align="center">{{ $data->bulan_bk }}</td>
                                <td align="center">{{ $data->bulan_pk }}</td>
                                <td>{{ $data->tpp_tambahan }}</td>
                                <td>
                                    @if(Auth::user()->role_id == 1)
                                        <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ubahModalPegawai{{ $i }}"><i class="fa fa-edit"></i></button>
                                        <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></button>
                                    @elseif(Auth::user()->role_id == 2)
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalCatatan{{ $i }}"><i class="fa fa-plus"></i> Catatan</button>

                                        <div class="modal fade" id="modalCatatan{{ $i }}" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="createModalLabel">Tambah Catatan</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('adminopd-catatan.store') }}" method="post">
                                                        <div class="modal-body">
                                                            @csrf
                                                            <input type="hidden" name="pegawai_id" value="{{ $data->id }}">
                                                            <div class="form-group">
                                                                <label for="catatan_opd">Catatan</label>
                                                                <textarea name="catatan_opd" id="catatan_opd" cols="30" rows="7" class="form-control" placeholder="Masukkan catatan . . ."></textarea>
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
                                    @endif
                                </td>
                            </tr>

                            <div class="modal fade" id="ubahModalPegawai{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="createModalLabel">Ubah Data Pegawai</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('adminopd-pegawai.update', $data->id) }}" method="post" enctype="multipart/form-data">
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
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="opd_id">OPD</label>
                                                    <select type="text" name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                                        @foreach(\App\Models\Opd::orderBy('nama_opd', 'ASC')->get() as $opd)
                                                            <option value="{{ $opd->id }}" @if($opd->id == $data->opd_id) selected @endif>{{ $opd->nama_opd }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kode_jabatanlama">Jabatan</label>
                                                    <select type="text" name="kode_jabatanlama" class="form-control @error('kode_jabatanlama') is-invalid @enderror">
                                                        @foreach(\App\Models\Jabatan::data() as $jabatan)
                                                            <option value="{{ $jabatan->id }}" @if($jabatan->id == $data->kode_jabatanlama) selected @endif>{{ $jabatan->nama_jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sts_jabatan">Status Jabatan</label>
                                                    <input type="text" name="sts_jabatan"
                                                        class="form-control @error('sts_jabatan') is-invalid @enderror" id="sts_jabatan"
                                                        placeholder="Status Jabatan . . ." value="{{ $data->sts_jabatan }}">
                                                    @error('sts_jabatan')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pangkat">Pangkat</label>
                                                    <input type="text" name="pangkat"
                                                        class="form-control @error('pangkat') is-invalid @enderror" id="pangkat"
                                                        placeholder="Pangkat . . ." value="{{ $data->pangkat }}">
                                                    @error('pangkat')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="golongan">Golongan</label>
                                                    <input type="text" name="golongan"
                                                        class="form-control @error('golongan') is-invalid @enderror" id="golongan"
                                                        placeholder="Golongan . . ." value="{{ $data->golongan }}">
                                                    @error('golongan')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="eselon">Eselon</label>
                                                    <input type="text" name="eselon"
                                                        class="form-control @error('eselon') is-invalid @enderror" id="eselon"
                                                        placeholder="Eselon . . ." value="{{ $data->eselon }}">
                                                    @error('eselon')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tpp">Status Penerimaan TPP</label>
                                                    <input type="text" name="tpp"
                                                        class="form-control @error('tpp') is-invalid @enderror" id="tpp"
                                                        placeholder="Status Penerimaan TPP . . ." value="{{ $data->tpp }}">
                                                    @error('tpp')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="nama_opd">Sertifikasi Guru</label>
                                                    <input type="text" name="nama_opd"
                                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                        placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                    @error('nama_opd')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                 <div class="form-group">
                                                    <label for="nama_opd">Tipe Jabatan</label>
                                                    <input type="text" name="nama_opd"
                                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                        placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                    @error('nama_opd')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div> 
                                                 <div class="form-group">
                                                    <label for="nama_opd">Subkoor</label>
                                                    <input type="text" name="nama_opd"
                                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                        placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                    @error('nama_opd')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama_opd">Nama Subkoor</label>
                                                    <input type="text" name="nama_opd"
                                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                        placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                    @error('nama_opd')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div> 
                                                 <div class="form-group">
                                                    <label for="nama_opd">Status Subkoor</label>
                                                    <input type="text" name="nama_opd"
                                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                        placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                    @error('nama_opd')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div> 
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
                                                    <label for="pensiun">Pensiun</label>
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
                        @endforeach
                    </tbody>
                </table>
                {{ $datas->appends([
                    'search' => $search,
                    'filter' => $filter,
                    ])->links() }}
            </div>
        </div>
        <div class="text-center">
            {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
        </div>
        <div class="modal fade" id="createModalPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Tambah Data Pegawai</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('adminopd-pegawai.store') }}" method="post" enctype="multipart/form-data">
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
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="opd_id">OPD</label>
                                                    <select type="text" name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                                        @foreach(\App\Models\Opd::orderBy('nama_opd', 'ASC')->get() as $opd)
                                                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="kode_jabatanlama">Jabatan</label>
                                                    <select type="text" name="kode_jabatanlama" class="form-control @error('kode_jabatanlama') is-invalid @enderror">
                                                        @foreach(\App\Models\Jabatan::data() as $jabatan)
                                                            <option value="{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="sts_jabatan">Status Jabatan</label>
                                                    <input type="text" name="sts_jabatan"
                                                        class="form-control @error('sts_jabatan') is-invalid @enderror" id="sts_jabatan"
                                                        placeholder="Status Jabatan . . ." value="">
                                                    @error('sts_jabatan')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pangkat">Pangkat</label>
                                                    <input type="text" name="pangkat"
                                                        class="form-control @error('pangkat') is-invalid @enderror" id="pangkat"
                                                        placeholder="Pangkat . . ." value="">
                                                    @error('pangkat')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="golongan">Golongan</label>
                                                    <input type="text" name="golongan"
                                                        class="form-control @error('golongan') is-invalid @enderror" id="golongan"
                                                        placeholder="Golongan . . ." value="">
                                                    @error('golongan')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="eselon">Eselon</label>
                                                    <input type="text" name="eselon"
                                                        class="form-control @error('eselon') is-invalid @enderror" id="eselon"
                                                        placeholder="Eselon . . ." value="">
                                                    @error('eselon')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tpp">Status Penerimaan TPP</label>
                                                    <input type="text" name="tpp"
                                                        class="form-control @error('tpp') is-invalid @enderror" id="tpp"
                                                        placeholder="Status Penerimaan TPP . . ." value="">
                                                    @error('tpp')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="pensiun">Pensiun</label>
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
    </div>
</div>

<form action="" method="post" id="deleteForm">
    @csrf
    @method("DELETE")
<button type="submit" style="display:none">Hapus</button>
</form>

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

    toggleColumn(7, false);
    toggleColumn(13, false);
    toggleColumn(14, false);
    toggleColumn(15, false);
    toggleColumn(16, false);
    toggleColumn(17, false);
    toggleColumn(18, false);
    toggleColumn(19, false);
    toggleColumn(20, false);
    toggleColumn(21, false);
    toggleColumn(22, false);
    toggleColumn(23, false);
    toggleColumn(24, false);
    //toggleColumn(25, false);

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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $('button#delete').on('click', function(e){
            e.preventDefault();

            var href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah anda yakin hapus data?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                if (result.value) {
                    document.getElementById('deleteForm').action = href;
                    document.getElementById('deleteForm').submit();

                    // Swal.fire(
                    //     'Berhasil!',
                    //     'Data telah dihapus.',
                    //     'success'
                    // )
                }
            })
        })
</script>

@endsection