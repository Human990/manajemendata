@extends('admin-kota.template.default')
@section('title', 'Data Pegawai')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Data Pegawai Tahun {{ session()->get('tahun_session') }}</h3>
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
                    </div>
                </form>
            </div>
            {{-- <div class="card-body">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalPegawai">Tambah Data</a>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="3%">NIP</th>
                                <th width="3%">Nama Pegawai</th>
                                <th width="3%">Status Pegawai</th>
                                <th width="3%">OPD</th>
                                <th width="3%">Nama Jabatan</th>
                                <th width="3%">Jenis Jabatan</th>
                                <th width="3%">Status Jabatan</th>
                                <th width="3%">Nilai Jabatan (JV)</th>
                                <th width="3%">Indeks</th>
                                <th width="3%">Pangkat</th>
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
                                <th width="3%">Jumlah Bulan Penerimaan</th>
                                <th width="4%">Tpp Tambahan</th>
                                <th width="9%">Action</th>
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
                                    <td>{{ $data->opds ? $data->opds->nama_opd : 'Tidak ditemukan' }}</td>
                                    {{-- <td>{{ $data->ukor_eselon2}}</td> --}}
                                    <td>{{ $data->jabatans ? $data->jabatans->nama_jabatan : 'Tidak Ada Jabatan' }}</td>
                                    <td>{{ $data->jabatans ? $data->jabatans->jenis_jabatan : 'Tidak Ada Jabatan' }}</td>
                                    <td>{{ $data->sts_jabatan }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $data->pangkat }}</td>
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
                                    <td>{{ $data->bulan }}</td>
                                    <td>{{ $data->tpp_tambahan }}</td>
                                    <td>
                                        {{-- <button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalPegawai{{ $i }}"><i class="fa fa-eye"></i> Ubah</button> --}}
                                        {{-- <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button> --}}
                                    </td>
                                </tr>

                                {{-- <div class="modal fade" id="ubahModalPegawai{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
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
                                                            placeholder="Kode OPD . . ." value="{{ $data->nip }}">
                                                        @error('nip')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pegawai">Nama Pegawai</label>
                                                        <input type="text" name="nama_pegawai"
                                                            class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                                            placeholder="Kode Sub OPD . . ." value="{{ $data->nama_pegawai }}">
                                                        @error('nama_pegawai')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_pegawai">Status Pegawai</label>
                                                        <input type="text" name="sts_pegawai"
                                                            class="form-control @error('sts_pegawai') is-invalid @enderror" id="sts_pegawai"
                                                            placeholder="Nama OPD . . ." value="{{ $data->sts_pegawai }}">
                                                        @error('sts_pegawai')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="opd_id">OPD</label>
                                                        <select type="text" name="opd_id"
                                                            class="form-control @error('opd_id') is-invalid @enderror">
                                                        <option value="{{ $data->opd_id }}" {{ $data->opd_id == $data->opd->id ? 'selected' : '' }}>
                                                            {{ $data->opd->nama_opd }}
                                                        </option>
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Nama Jabatan</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Status Jabatan</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Pangkat</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Eselon</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Status Penerimaan TPP</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
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
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Jumlah Bulan Penerimaan</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Tpp Tambahan</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
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
                            @endforeach
                        </tbody>
                    </table>
                    {{ $datas->appends(['search' => $search])->links() }}
                </div>
            </div>
            <div class="text-center">
                {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
            </div>
            {{-- <div class="modal fade" id="createModalPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
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
                                        placeholder="NIP . . ." value="{{ old('nip') }}">
                                    @error('nip')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_pegawai">Nama Pegawai</label>
                                    <input type="text" name="nama_pegawai"
                                        class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                        placeholder="Nama Pegawai . . ." value="{{ old('nama_pegawai') }}">
                                    @error('nama_pegawai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sts_pegawai">Status Pegawai</label>
                                    <input type="text" name="sts_pegawai"
                                        class="form-control @error('sts_pegawai') is-invalid @enderror" id="sts_pegawai"
                                        placeholder="Status Pegawai . . ." value="{{ old('sts_pegawai') }}">
                                    @error('sts_pegawai')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="opd_id">OPD</label>
                                    <select name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                        <option value="">Pilih OPD</option>
                                        @foreach ($opdOptions as $opd)
                                            <option value="{{ $opd->id }}" {{ $data->opd_id == $opd->id ? 'selected' : '' }}>
                                                {{ $opd->nama_opd }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('opd_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="ukor_eselon2">OPD</label>
                                    <input type="text" name="ukor_eselon2"
                                        class="form-control @error('ukor_eselon2') is-invalid @enderror" id="ukor_eselon2"
                                        placeholder="OPD . . ." value="{{ old('ukor_eselon2') }}">
                                    @error('ukor_eselon2')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kode_jabatanlama">Jabatan</label>
                                    <select name="kode_jabatanlama" class="form-control select2jabatan" style="width:100%;">
                                        <option value="" selected disabled>Pilih Jabatan</option>
                                        @foreach($jabatanOptions as $jabatan)
                                            <option value="{{ $jabatan->kode_jabatanlama }}">{{ $jabatan->nama_jabatan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pangkat">Pangkat</label>
                                    <input type="text" name="pangkat"
                                        class="form-control @error('pangkat') is-invalid @enderror" id="pangkat"
                                        placeholder="Pangkat . . ." value="{{ old('pangkat') }}">
                                    @error('pangkat')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="eselon">Eselon</label>
                                    <input type="text" name="eselon"
                                        class="form-control @error('eselon') is-invalid @enderror" id="eselon"
                                        placeholder="Eselon . . ." value="{{ old('eselon') }}">
                                    @error('eselon')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tpp">Status Penerimaan TPP</label>
                                    <select name="tpp" class="form-control @error('tpp') is-invalid @enderror" id="tpp">
                                        <option value="" selected disabled hidden>Pilih Status</option>
                                        <option value="Penerima TPP">Penerima TPP</option>
                                        <option value="Bukan Penerima TPP">Bukan Penerima TPP</option>
                                    </select>
                                    @error('tpp')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sertifikasi_guru">Sertifikasi Guru</label>
                                    <select name="sertifikasi_guru" class="form-control @error('sertifikasi_guru') is-invalid @enderror" id="sertifikasi_guru">
                                        <option value="">Pilih status sertifikasi . . .</option>
                                        <option value="Sudah Sertifikasi">Sudah Sertifikasi</option>
                                        <option value="Belum Sertifikasi">Belum Sertifikasi</option>
                                    </select>
                                    @error('sertifikasi_guru')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pa_kpa">PA/KPA</label>
                                    <select name="pa_kpa" class="form-control @error('pa_kpa') is-invalid @enderror" id="pa_kpa">
                                        <option value="">Belum Dipilih . . .</option>
                                        <option value="PA/KPA">PA/KPA</option>
                                        <option value="Bukan PA/KPA">Bukan PA/KPA</option>
                                    </select>
                                    @error('pa_kpa')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pbj">Sertifikasi PBJ</label>
                                    <select name="pbj" class="form-control @error('pbj') is-invalid @enderror" id="pbj">
                                        <option value="">Pilih status PBJ . . .</option>
                                        <option value="Sudah Memiliki Sertifikat">Sudah Memiliki Sertifikat</option>
                                        <option value="Belum Memiliki Sertifikat">Belum Memiliki Sertifikat</option>
                                    </select>
                                    @error('pbj')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="jft">Tipe Jabatan</label>
                                    <select name="jft" class="form-control @error('jft') is-invalid @enderror" id="jft">
                                        <option value="" selected disabled hidden>Pilih Tipe Jabatan . . .</option>
                                        <option value="Jabatan Administratif">Jabatan Administratif</option>
                                        <option value="Jabatan Fungsional">Jabatan Fungsional</option>
                                        <option value="Jabatan Fungsional Belum Diangkat">Jabatan Fungsional Belum Diangkat</option>
                                    </select>
                                    @error('jft')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="subkoor">Subkoor</label>
                                    <input type="text" name="subkoor"
                                        class="form-control @error('subkoor') is-invalid @enderror" id="subkoor"
                                        placeholder="Subkoor . . ." value="{{ old('subkoor') }}">
                                    @error('subkoor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="nama_subkoor">Nama Subkoor</label>
                                    <input type="text" name="nama_subkoor"
                                        class="form-control @error('nama_subkoor') is-invalid @enderror" id="nama_subkoor"
                                        placeholder="Nama Subkoor . . ." value="{{ old('nama_subkoor') }}">
                                    @error('nama_subkoor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="sts_subkoor">Status Subkoor</label>
                                    <select name="sts_subkoor" class="form-control @error('sts_subkoor') is-invalid @enderror" id="sts_subkoor">
                                        <option value="">Bukan Subkoor</option>
                                        <option value="Subkoordinator Hasil Penyetaraan">Subkoordinator Hasil Penyetaraan</option>
                                        <option value="Subkoordinator Bukan Hasil Penyetaraan">Subkoordinator Bukan Hasil Penyetaraan</option>
                                    </select>
                                    @error('sts_subkoor')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="atasan_nip">Nip Atasan Langsung</label>
                                    <input type="text" name="atasan_nip"
                                        class="form-control @error('atasan_nip') is-invalid @enderror" id="atasan_nip"
                                        placeholder="Nip Atasan Langsung . . ." value="{{ old('atasan_nip') }}">
                                    @error('atasan_nip')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="atasan_nama">Nama Atasan Langsung</label>
                                    <input type="text" name="atasan_nama"
                                        class="form-control @error('atasan_nama') is-invalid @enderror" id="atasan_nama"
                                        placeholder="Nama Atasan Langsung . . ." value="{{ old('atasan_nama') }}">
                                    @error('atasan_nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="atasannya_atasan_nip">Nip Atasan Penilai</label>
                                    <input type="text" name="atasannya_atasan_nip"
                                        class="form-control @error('atasannya_atasan_nip') is-invalid @enderror" id="atasannya_atasan_nip"
                                        placeholder="Nip Atasannya Penilai . . ." value="{{ old('atasannya_atasan_nip') }}">
                                    @error('atasannya_atasan_nip')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="atasannya_atasan_nama">Nama Atasan Penilai</label>
                                    <input type="text" name="atasannya_atasan_nama"
                                        class="form-control @error('atasannya_atasan_nama') is-invalid @enderror" id="atasannya_atasan_nama"
                                        placeholder="Nama Atasan Penilai . . ." value="{{ old('atasannya_atasan_nama') }}">
                                    @error('atasannya_atasan_nama')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="bulan">Jumlah Bulan Penerimaan</label>
                                    <input type="text" name="bulan"
                                        class="form-control @error('bulan') is-invalid @enderror" id="bulan"
                                        placeholder="Jumlah Bulan Penerimaan . . ." value="{{ old('bulan') }}">
                                    @error('bulan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="tpp_tambahan">Tpp Tambahan</label>
                                    <input type="text" name="tpp_tambahan"
                                        class="form-control @error('tpp_tambahan') is-invalid @enderror" id="tpp_tambahan"
                                        placeholder="Tpp Tambahan . . ." value="{{ old('tpp_tambahan') }}">
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
            </div> --}}
        </div>
    </div>
    
@endsection
