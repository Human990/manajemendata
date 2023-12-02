@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Master Jabatan Tahun {{ session()->get('tahun_session') }} <a href="#" style="float:right" class="btn btn-info" data-toggle="modal" data-target="#createModalIndeks">Tambah Data</a> </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('adminkota-jabatan') }}" method="GET">
                <div>
                    <label for="search">Cari:</label>
                    <input class="form-control" type="text" name="search" value="{{ $search ?? '' }}">
                </div>
            
                <!-- Bagian Records Per Page -->
                <div>
                    <label for="recordsPerPage">Records Per Page:</label>
                    <select class="form-control mr-2" name="recordsPerPage">
                        <option value="10" {{ $pagination == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ $pagination == 25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $pagination == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ $pagination == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
                <div>
                    <button class="btn btn-sm btn-info mt-2 mb-2" type="submit">
                        <i class="fas fa-search fa-sm"></i> Pencarian
                    </button>
                    <a href="{{ route('adminkota-tpp-pegawai')}}" class="btn btn-sm btn-warning mt-2 mb-2">reset</a>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr style="background-color:#fff0da">
                            <td width="1%" rowspan="2" align="center"><b>No</b></td>
                            <td width="3%" rowspan="2" align="center"><b>Tahun</b></td>
                            <td width="24%" rowspan="2" align="center"><b>Nama Jabatan</b></td>
                            <td width="20%" colspan="5" align="center"><b>Murni</b></td>
                            <td width="20%" colspan="5" align="center"><b>Subkoordinator </br> Hasil Penyetaraan</b></td>
                            <td width="20%" colspan="5" align="center"><b>Subkoordinator </br> Bukan Hasil Penyetaraan</b></td>
                            <td width="20%" colspan="5" align="center"><b>Koordinator </br> Hasil Penyetaraan</b></td>
                            <td width="20%" colspan="5" align="center"><b>Koordinator </br> Bukan Hasil Penyetaraan</b></td>
                            <td width="7%" rowspan="2" align="center"><b>Tunjab Murni</b></td>
                            <td width="7%" rowspan="2" align="center"><b>Tunjab Subkoor</b></td>
                            <td width="7%" rowspan="2" align="center"><b>Tunjab Koor</b></td>
                            <td width="5%" rowspan="2" align="center"><b>Action</b></td>
                        </tr>
                        <tr style="background-color:#fff0da">
                            <td><b>Jenis</b></td>
                            <td><b>Kelas</b></td>
                            <td><b>Nilai</b></td>
                            <td><b>Indeks</b></td>
                            <td><b>%</b></td>
                            <td><b>Jenis</b></td>
                            <td><b>Kelas</b></td>
                            <td><b>Nilai</b></td>
                            <td><b>Indeks</b></td>
                            <td><b>%</b></td>
                            <td><b>Jenis</b></td>
                            <td><b>Kelas</b></td>
                            <td><b>Nilai</b></td>
                            <td><b>Indeks</b></td>
                            <td><b>%</b></td>
                            <td><b>Jenis</b></td>
                            <td><b>Kelas</b></td>
                            <td><b>Nilai</b></td>
                            <td><b>Indeks</b></td>
                            <td><b>%</b></td>
                            <td><b>Jenis</b></td>
                            <td><b>Kelas</b></td>
                            <td><b>Nilai</b></td>
                            <td><b>Indeks</b></td>
                            <td><b>%</b></td>
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
                                <td align="center">{{ $data->prosentase_penerimaan_murni }}</td>
                                <td>{{ $data->jenis_penyetaraan }}</td>
                                <td>{{ $data->kelas_jabatan_subkor_penyetaraan }}</td>
                                <td align="right">{{ number_format((float)$data->nilai_jabatan_subkor_penyetaraan, 0, ',', '.') }}</td>
                                <td align="right">{{ $data->indeks_subkor_penyetaraan }}</td>
                                <td align="center">{{ $data->prosentase_penerimaan_subkor_penyetaraan }}</td>
                                <td>{{ $data->jenis_non_penyetaraan }}</td>
                                <td>{{ $data->kelas_jabatan_subkor_non_penyetaraan }}</td>
                                <td align="right">{{ number_format((float)$data->nilai_jabatan_subkor_non_penyetaraan, 0, ',', '.') }}</td>
                                <td align="right">{{ $data->indeks_subkor_non_penyetaraan }}</td>
                                <td align="center">{{ $data->prosentase_penerimaan_subkor_non_penyetaraan }}</td>

                                <td>{{ $data->jenis_koor_penyetaraan }}</td>
                                <td>{{ $data->kelas_jabatan_koor_penyetaraan }}</td>
                                <td align="right">{{ number_format((float)$data->nilai_jabatan_koor_penyetaraan, 0, ',', '.') }}</td>
                                <td align="right">{{ $data->indeks_koor_penyetaraan }}</td>
                                <td align="center">{{ $data->prosentase_penerimaan_koor_penyetaraan }}</td>
                                <td>{{ $data->jenis_koor_non_penyetaraan }}</td>
                                <td>{{ $data->kelas_jabatan_koor_non_penyetaraan }}</td>
                                <td align="right">{{ number_format((float)$data->nilai_jabatan_koor_non_penyetaraan, 0, ',', '.') }}</td>
                                <td align="right">{{ $data->indeks_koor_non_penyetaraan }}</td>
                                <td align="center">{{ $data->prosentase_penerimaan_koor_non_penyetaraan }}</td>

                                <td align="right">{{ number_format($data->tunjab, 0, ',', '.') }}</td>
                                <td align="right">{{ number_format($data->tunjab_subkor, 0, ',', '.') }}</td>
                                <td align="right">{{ number_format($data->tunjab_koor, 0, ',', '.') }}</td>
                                <td>
                                    <button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks{{ $i }}">Ubah</button>
                                    {{-- <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button> --}}
                                </td>
                            </tr>

                            <div class="modal fade" id="ubahModalIndeks{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
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
                                                
                                                <div class="alert alert-info" role="alert">
                                                    <b>JABATAN MURNI</b></br></br>
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
                                                    <div class="form-group">
                                                        <label for="prosentase_penerimaan_murni">% Penerimaan</label>
                                                        <input type="number" name="prosentase_penerimaan_murni"
                                                            class="form-control @error('prosentase_penerimaan_murni') is-invalid @enderror" id="prosentase_penerimaan_murni"
                                                            placeholder="% Penerimaan . . ." value="{{ $data->prosentase_penerimaan_murni }}">
                                                        @error('prosentase_penerimaan_murni')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                
                                                <div class="alert alert-warning" role="alert">
                                                    <b>SUBKOORDINATOR HASIL PENYETARAAN</b></br></br>
                                                    <div class="form-group">
                                                        <label for="nilai_jabatan_subkor_penyetaraan">Nilai Jabatan</label>
                                                        <input type="text" name="nilai_jabatan_subkor_penyetaraan"
                                                            class="form-control @error('nilai_jabatan_subkor_penyetaraan') is-invalid @enderror" id="nilai_jabatan_subkor_penyetaraan"
                                                            placeholder="Nilai Jabatan . . ." value="{{ $data->nilai_jabatan_subkor_penyetaraan }}">
                                                        @error('nilai_jabatan_subkor_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="indeks_subkor_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                                        <select name="indeks_subkor_penyetaraan_id" id="indeks_subkor_penyetaraan_id" class="form-control">
                                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                                <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $data->indeks_subkor_penyetaraan_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('indeks_subkor_penyetaraan_id')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prosentase_penerimaan_subkor_penyetaraan">% Penerimaan</label>
                                                        <input type="number" name="prosentase_penerimaan_subkor_penyetaraan"
                                                            class="form-control @error('prosentase_penerimaan_subkor_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_subkor_penyetaraan"
                                                            placeholder="% Penerimaan . . ." value="{{ $data->prosentase_penerimaan_subkor_penyetaraan }}">
                                                        @error('prosentase_penerimaan_subkor_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="alert alert-warning" role="alert">
                                                    <b>SUBKOORDINATOR BUKAN HASIL PENYETARAAN</b></br></br>
                                                    <div class="form-group">
                                                        <label for="nilai_jabatan_subkor_non_penyetaraan">Nilai Jabatan</label>
                                                        <input type="text" name="nilai_jabatan_subkor_non_penyetaraan"
                                                            class="form-control @error('nilai_jabatan_subkor_non_penyetaraan') is-invalid @enderror" id="nilai_jabatan_subkor_non_penyetaraan"
                                                            placeholder="Nilai Jabatan . . ." value="{{ $data->nilai_jabatan_subkor_non_penyetaraan }}">
                                                        @error('nilai_jabatan_subkor_non_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="indeks_subkor_non_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                                        <select name="indeks_subkor_non_penyetaraan_id" id="indeks_subkor_non_penyetaraan_id" class="form-control">
                                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                                <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $data->indeks_subkor_non_penyetaraan_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('indeks_subkor_non_penyetaraan_id')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prosentase_penerimaan_subkor_non_penyetaraan">% Penerimaan</label>
                                                        <input type="number" name="prosentase_penerimaan_subkor_non_penyetaraan"
                                                            class="form-control @error('prosentase_penerimaan_subkor_non_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_subkor_non_penyetaraan"
                                                            placeholder="% Penerimaan . . ." value="{{ $data->prosentase_penerimaan_subkor_non_penyetaraan }}">
                                                        @error('prosentase_penerimaan_subkor_non_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="alert alert-success" role="alert">
                                                    <b>KOORDINATOR HASIL PENYETARAAN</b></br></br>
                                                    <div class="form-group">
                                                        <label for="nilai_jabatan_koor_penyetaraan">Nilai Jabatan</label>
                                                        <input type="text" name="nilai_jabatan_koor_penyetaraan"
                                                            class="form-control @error('nilai_jabatan_koor_penyetaraan') is-invalid @enderror" id="nilai_jabatan_koor_penyetaraan"
                                                            placeholder="Nilai Jabatan . . ." value="{{ $data->nilai_jabatan_koor_penyetaraan }}">
                                                        @error('nilai_jabatan_koor_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="indeks_koor_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                                        <select name="indeks_koor_penyetaraan_id" id="indeks_koor_penyetaraan_id" class="form-control">
                                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                                <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $data->indeks_koor_penyetaraan_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('indeks_koor_penyetaraan_id')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prosentase_penerimaan_koor_penyetaraan">% Penerimaan</label>
                                                        <input type="number" name="prosentase_penerimaan_koor_penyetaraan"
                                                            class="form-control @error('prosentase_penerimaan_koor_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_koor_penyetaraan"
                                                            placeholder="% Penerimaan . . ." value="{{ $data->prosentase_penerimaan_koor_penyetaraan }}">
                                                        @error('prosentase_penerimaan_koor_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="alert alert-success" role="alert">
                                                    <b>KOORDINATOR BUKAN HASIL PENYETARAAN</b></br></br>
                                                    <div class="form-group">
                                                        <label for="nilai_jabatan_koor_non_penyetaraan">Nilai Jabatan</label>
                                                        <input type="text" name="nilai_jabatan_koor_non_penyetaraan"
                                                            class="form-control @error('nilai_jabatan_koor_non_penyetaraan') is-invalid @enderror" id="nilai_jabatan_koor_non_penyetaraan"
                                                            placeholder="Nilai Jabatan . . ." value="{{ $data->nilai_jabatan_koor_non_penyetaraan }}">
                                                        @error('nilai_jabatan_koor_non_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="indeks_koor_non_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                                        <select name="indeks_koor_non_penyetaraan_id" id="indeks_koor_non_penyetaraan_id" class="form-control">
                                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                                <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $data->indeks_koor_non_penyetaraan_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('indeks_koor_non_penyetaraan_id')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="prosentase_penerimaan_koor_non_penyetaraan">% Penerimaan</label>
                                                        <input type="number" name="prosentase_penerimaan_koor_non_penyetaraan"
                                                            class="form-control @error('prosentase_penerimaan_koor_non_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_koor_non_penyetaraan"
                                                            placeholder="% Penerimaan . . ." value="{{ $data->prosentase_penerimaan_koor_non_penyetaraan }}">
                                                        @error('prosentase_penerimaan_koor_non_penyetaraan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="tunjab">Tunjangan Jabatan Murni</label>
                                                    <input type="number" name="tunjab"
                                                        class="form-control @error('tunjab') is-invalid @enderror" id="tunjab"
                                                        placeholder="Tunjangan Jabatan . . ." value="{{ $data->tunjab }}">
                                                    @error('tunjab')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tunjab_subkor">Tunjangan Jabatan Subkoordinator</label>
                                                    <input type="number" name="tunjab_subkor"
                                                        class="form-control @error('tunjab_subkor') is-invalid @enderror" id="tunjab_subkor"
                                                        placeholder="Tunjangan Jabatan Subkoordinator . . ." value="{{ $data->tunjab_subkor }}">
                                                    @error('tunjab_subkor')
                                                        <span class="invalid-feedback">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="tunjab_koor">Tunjangan Jabatan Koordinator</label>
                                                    <input type="number" name="tunjab_koor"
                                                        class="form-control @error('tunjab_koor') is-invalid @enderror" id="tunjab_koor"
                                                        placeholder="Tunjangan Jabatan Koordinator . . ." value="{{ $data->tunjab_koor }}">
                                                    @error('tunjab_koor')
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
            <span style="float:right">
            {{ $datas->appends([ 'search' => $search , 'recordsPerPage' => $pagination ])->links() }}</span>
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

                            <div class="alert alert-info" role="alert">
                                <b>JABATAN MURNI</b></br></br>
                                <div class="form-group">
                                    <label for="nilai_jabatan">Nilai Jabatan</label>
                                    <input type="text" name="nilai_jabatan"
                                        class="form-control @error('nilai_jabatan') is-invalid @enderror" id="nilai_jabatan"
                                        placeholder="Nilai Jabatan . . ." value="{{ old('nilai_jabatan') }}">
                                    @error('nilai_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="alert alert-warning" role="alert">
                                    <b>SUB KOOR / KOOR HASIL PENYETARAAN</b></br></br>
                                    <div class="form-group">
                                        <label for="nilai_jabatan_subkor_penyetaraan">Nilai Jabatan</label>
                                        <input type="text" name="nilai_jabatan_subkor_penyetaraan"
                                            class="form-control @error('nilai_jabatan_subkor_penyetaraan') is-invalid @enderror" id="nilai_jabatan_subkor_penyetaraan"
                                            placeholder="Nilai Jabatan . . ." value="{{ old('nilai_jabatan_subkor_penyetaraan') }}">
                                        @error('nilai_jabatan_subkor_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="indeks_subkor_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                        <select name="indeks_subkor_penyetaraan_id" id="indeks_subkor_penyetaraan_id" class="form-control">
                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                            @endforeach
                                        </select>
                                        @error('indeks_subkor_penyetaraan_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="prosentase_penerimaan_subkor_penyetaraan">% Penerimaan</label>
                                        <input type="number" name="prosentase_penerimaan_subkor_penyetaraan"
                                            class="form-control @error('prosentase_penerimaan_subkor_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_subkor_penyetaraan"
                                            placeholder="% Penerimaan . . ." value="{{ old('prosentase_penerimaan_subkor_penyetaraan') }}">
                                        @error('prosentase_penerimaan_subkor_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="alert alert-warning" role="alert">
                                    <b>SUB KOOR / KOOR BUKAN HASIL PENYETARAAN</b></br></br>
                                    <div class="form-group">
                                        <label for="nilai_jabatan_subkor_non_penyetaraan">Nilai Jabatan</label>
                                        <input type="text" name="nilai_jabatan_subkor_non_penyetaraan"
                                            class="form-control @error('nilai_jabatan_subkor_non_penyetaraan') is-invalid @enderror" id="nilai_jabatan_subkor_non_penyetaraan"
                                            placeholder="Nilai Jabatan . . ." value="{{ old('nilai_jabatan_subkor_non_penyetaraan') }}">
                                        @error('nilai_jabatan_subkor_non_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="indeks_subkor_non_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                        <select name="indeks_subkor_non_penyetaraan_id" id="indeks_subkor_non_penyetaraan_id" class="form-control">
                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                            @endforeach
                                        </select>
                                        @error('indeks_subkor_non_penyetaraan_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="prosentase_penerimaan_subkor_non_penyetaraan">% Penerimaan</label>
                                        <input type="number" name="prosentase_penerimaan_subkor_non_penyetaraan"
                                            class="form-control @error('prosentase_penerimaan_subkor_non_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_subkor_non_penyetaraan"
                                            placeholder="% Penerimaan . . ." value="{{ old('prosentase_penerimaan_subkor_non_penyetaraan') }}">
                                        @error('prosentase_penerimaan_subkor_non_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="alert alert-success" role="alert">
                                    <b>KOORDINATOR HASIL PENYETARAAN</b></br></br>
                                    <div class="form-group">
                                        <label for="nilai_jabatan_koor_penyetaraan">Nilai Jabatan</label>
                                        <input type="text" name="nilai_jabatan_koor_penyetaraan"
                                            class="form-control @error('nilai_jabatan_koor_penyetaraan') is-invalid @enderror" id="nilai_jabatan_koor_penyetaraan"
                                            placeholder="Nilai Jabatan . . ." value="">
                                        @error('nilai_jabatan_koor_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="indeks_koor_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                        <select name="indeks_koor_penyetaraan_id" id="indeks_koor_penyetaraan_id" class="form-control">
                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                            @endforeach
                                        </select>
                                        @error('indeks_koor_penyetaraan_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="prosentase_penerimaan_koor_penyetaraan">% Penerimaan</label>
                                        <input type="number" name="prosentase_penerimaan_koor_penyetaraan"
                                            class="form-control @error('prosentase_penerimaan_koor_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_koor_penyetaraan"
                                            placeholder="% Penerimaan . . ." value="">
                                        @error('prosentase_penerimaan_koor_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="alert alert-success" role="alert">
                                    <b>KOORDINATOR BUKAN HASIL PENYETARAAN</b></br></br>
                                    <div class="form-group">
                                        <label for="nilai_jabatan_koor_non_penyetaraan">Nilai Jabatan</label>
                                        <input type="text" name="nilai_jabatan_koor_non_penyetaraan"
                                            class="form-control @error('nilai_jabatan_koor_non_penyetaraan') is-invalid @enderror" id="nilai_jabatan_koor_non_penyetaraan"
                                            placeholder="Nilai Jabatan . . ." value="">
                                        @error('nilai_jabatan_koor_non_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="indeks_koor_non_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                        <select name="indeks_koor_non_penyetaraan_id" id="indeks_koor_non_penyetaraan_id" class="form-control">
                                            @foreach(\App\Models\Indeks::data() as $indeks)
                                                <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                            @endforeach
                                        </select>
                                        @error('indeks_koor_non_penyetaraan_id')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="prosentase_penerimaan_koor_non_penyetaraan">% Penerimaan</label>
                                        <input type="number" name="prosentase_penerimaan_koor_non_penyetaraan"
                                            class="form-control @error('prosentase_penerimaan_koor_non_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_koor_non_penyetaraan"
                                            placeholder="% Penerimaan . . ." value="">
                                        @error('prosentase_penerimaan_koor_non_penyetaraan')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
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
                                <div class="form-group">
                                    <label for="prosentase_penerimaan_murni">% Penerimaan</label>
                                    <input type="number" name="prosentase_penerimaan_murni"
                                        class="form-control @error('prosentase_penerimaan_murni') is-invalid @enderror" id="prosentase_penerimaan_murni"
                                        placeholder="% Penerimaan . . ." value="{{ old('prosentase_penerimaan_murni') }}">
                                    @error('prosentase_penerimaan_murni')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="alert alert-warning" role="alert">
                                <b>SUB KOOR / KOOR HASIL PENYETARAAN</b></br></br>
                                <div class="form-group">
                                    <label for="nilai_jabatan_subkor_penyetaraan">Nilai Jabatan</label>
                                    <input type="text" name="nilai_jabatan_subkor_penyetaraan"
                                        class="form-control @error('nilai_jabatan_subkor_penyetaraan') is-invalid @enderror" id="nilai_jabatan_subkor_penyetaraan"
                                        placeholder="Nilai Jabatan . . ." value="{{ old('nilai_jabatan_subkor_penyetaraan') }}">
                                    @error('nilai_jabatan_subkor_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks_subkor_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                    <select name="indeks_subkor_penyetaraan_id" id="indeks_subkor_penyetaraan_id" class="form-control">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                        @endforeach
                                    </select>
                                    @error('indeks_subkor_penyetaraan_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prosentase_penerimaan_subkor_penyetaraan">% Penerimaan</label>
                                    <input type="number" name="prosentase_penerimaan_subkor_penyetaraan"
                                        class="form-control @error('prosentase_penerimaan_subkor_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_subkor_penyetaraan"
                                        placeholder="% Penerimaan . . ." value="{{ old('prosentase_penerimaan_subkor_penyetaraan') }}">
                                    @error('prosentase_penerimaan_subkor_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <b>SUB KOOR / KOOR BUKAN HASIL PENYETARAAN</b></br></br>
                                <div class="form-group">
                                    <label for="nilai_jabatan_subkor_non_penyetaraan">Nilai Jabatan</label>
                                    <input type="text" name="nilai_jabatan_subkor_non_penyetaraan"
                                        class="form-control @error('nilai_jabatan_subkor_non_penyetaraan') is-invalid @enderror" id="nilai_jabatan_subkor_non_penyetaraan"
                                        placeholder="Nilai Jabatan . . ." value="{{ old('nilai_jabatan_subkor_non_penyetaraan') }}">
                                    @error('nilai_jabatan_subkor_non_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks_subkor_non_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                    <select name="indeks_subkor_non_penyetaraan_id" id="indeks_subkor_non_penyetaraan_id" class="form-control">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                        @endforeach
                                    </select>
                                    @error('indeks_subkor_non_penyetaraan_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prosentase_penerimaan_subkor_non_penyetaraan">% Penerimaan</label>
                                    <input type="number" name="prosentase_penerimaan_subkor_non_penyetaraan"
                                        class="form-control @error('prosentase_penerimaan_subkor_non_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_subkor_non_penyetaraan"
                                        placeholder="% Penerimaan . . ." value="{{ old('prosentase_penerimaan_subkor_non_penyetaraan') }}">
                                    @error('prosentase_penerimaan_subkor_non_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-success" role="alert">
                                <b>KOORDINATOR HASIL PENYETARAAN</b></br></br>
                                <div class="form-group">
                                    <label for="nilai_jabatan_koor_penyetaraan">Nilai Jabatan</label>
                                    <input type="text" name="nilai_jabatan_koor_penyetaraan"
                                        class="form-control @error('nilai_jabatan_koor_penyetaraan') is-invalid @enderror" id="nilai_jabatan_koor_penyetaraan"
                                        placeholder="Nilai Jabatan . . ." value="">
                                    @error('nilai_jabatan_koor_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks_koor_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                    <select name="indeks_koor_penyetaraan_id" id="indeks_koor_penyetaraan_id" class="form-control">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                        @endforeach
                                    </select>
                                    @error('indeks_koor_penyetaraan_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prosentase_penerimaan_koor_penyetaraan">% Penerimaan</label>
                                    <input type="number" name="prosentase_penerimaan_koor_penyetaraan"
                                        class="form-control @error('prosentase_penerimaan_koor_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_koor_penyetaraan"
                                        placeholder="% Penerimaan . . ." value="">
                                    @error('prosentase_penerimaan_koor_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="alert alert-success" role="alert">
                                <b>KOORDINATOR BUKAN HASIL PENYETARAAN</b></br></br>
                                <div class="form-group">
                                    <label for="nilai_jabatan_koor_non_penyetaraan">Nilai Jabatan</label>
                                    <input type="text" name="nilai_jabatan_koor_non_penyetaraan"
                                        class="form-control @error('nilai_jabatan_koor_non_penyetaraan') is-invalid @enderror" id="nilai_jabatan_koor_non_penyetaraan"
                                        placeholder="Nilai Jabatan . . ." value="">
                                    @error('nilai_jabatan_koor_non_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks_koor_non_penyetaraan_id">Jenis Jabatan / Kelas / Indeks</label>
                                    <select name="indeks_koor_non_penyetaraan_id" id="indeks_koor_non_penyetaraan_id" class="form-control">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                        @endforeach
                                    </select>
                                    @error('indeks_koor_non_penyetaraan_id')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="prosentase_penerimaan_koor_non_penyetaraan">% Penerimaan</label>
                                    <input type="number" name="prosentase_penerimaan_koor_non_penyetaraan"
                                        class="form-control @error('prosentase_penerimaan_koor_non_penyetaraan') is-invalid @enderror" id="prosentase_penerimaan_koor_non_penyetaraan"
                                        placeholder="% Penerimaan . . ." value="">
                                    @error('prosentase_penerimaan_koor_non_penyetaraan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tunjab">Tunjangan Jabatan Murni</label>
                                <input type="number" name="tunjab"
                                    class="form-control @error('tunjab') is-invalid @enderror" id="tunjab"
                                    placeholder="Tunjangan Jabatan . . ." value="">
                                @error('tunjab')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tunjab_subkor">Tunjangan Jabatan Subkoordinator</label>
                                <input type="number" name="tunjab_subkor"
                                    class="form-control @error('tunjab_subkor') is-invalid @enderror" id="tunjab_subkor"
                                    placeholder="Tunjangan Jabatan Subkoordinator . . ." value="">
                                @error('tunjab_subkor')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="tunjab_koor">Tunjangan Jabatan Koordinator</label>
                                <input type="number" name="tunjab_koor"
                                    class="form-control @error('tunjab_koor') is-invalid @enderror" id="tunjab_koor"
                                    placeholder="Tunjangan Jabatan Koordinator . . ." value="">
                                @error('tunjab_koor')
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
