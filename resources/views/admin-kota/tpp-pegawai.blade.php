@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Rekap TPP</b>/Per Person {{ session()->get('tahun_session') }}</h3>
            </div>

            {{-- <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importModal">Import</a>
            <a href="{{route('pegawaiexport')}}" class="btn btn-warning">Export</a>
        </div> --}}
            <div class="card-body">
                {{-- <div class="row d-flex align-items-center">
                    <div class="col-2">
                        <div class="alert alert-primary text-center mt-3" role="alert">
                            Jumlah Pegawai: {{ $jumlah_pegawai }}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="alert alert-success text-center mt-3" role="alert">
                            Jumlah PPPK: {{ $jumlah_pppk }}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="alert alert-info text-center mt-3" role="alert">
                            Jumlah PLT: {{ $jumlah_plt }}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="alert alert-warning text-center mt-3" role="alert">
                            Jumlah PLH: {{ $jumlah_plh }}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="alert alert-danger text-center mt-3" role="alert">
                            Jumlah Pengganti Sementara: {{  $jumlah_pengganti_sementara }}
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="alert alert-secondary text-center mt-3" role="alert">
                            Jumlah Pegawai Definitif: {{ $jumlah_pegawai_definitif}}
                        </div>
                    </div>
                </div> --}}
                <div class="card-body">
                    <form action="{{ route('adminkota-tpp-pegawai') }}" method="GET">
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
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#createFiltersubopdPegawai" type="button">filter SUBOPD</button>
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
                                <form action="{{ route('adminkota-tpp-pegawai') }}" method="GET" enctype="multipart/form-data">
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
                    <div class="modal fade" id="createFiltersubopdPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createModalLabel">Filter Data Pegawai</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('adminkota-tpp-pegawai') }}" method="GET" enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="filtersubopd">SUB OPD</label>
                                            <select type="text" name="filtersubopd" class="form-control @error('filtersubopd') is-invalid @enderror">
                                                @foreach(\App\Models\Subopd::data() as $subopd)
                                                    <option value="{{ $subopd->id }}">{{ $subopd->nama_sub_opd }}</option>
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
                    <form action="{{ route('adminkota-tpp-pegawai') }}" method="GET" class="form-inline">
                        <label for="recordsPerPage" class="mr-2">show:</label>
                        <select name="recordsPerPage" id="recordsPerPage" class="form-control mr-2" onchange="this.form.submit()">
                            <option value="10" {{ request('recordsPerPage', 10) == 10 ? 'selected' : '' }}>10</option>
                            <option value="20" {{ request('recordsPerPage', 10) == 20 ? 'selected' : '' }}>20</option>
                            <option value="50" {{ request('recordsPerPage', 10) == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('recordsPerPage', 10) == 100 ? 'selected' : '' }}>100</option>
                        </select>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                
                                <th width="1%">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>OPD</th>
                                <th>Status Pegawai</th>
                                <th>Nama Jabatan Murni</th>
                                <th>Nama Jabatan</th>
                                <th>Jenis Jabatan Murni</th>
                                <th>Jenis Jabatan</th>
                                <th>Kelas Jabatan Murni</th>
                                <th>Kelas Jabatan</th>
                                <th>Nilai Jabatan Murni</th>
                                <th>Nilai Jabatan</th>
                                <th>Indeks Jabatan Murni</th>
                                <th>Indeks Jabatan</th>
                                <th>Total Bulan Penerimaan BK</th>
                                <th>Total Bulan Penerimaan PK</th>
                                <th>RP/BLN Beban Kerja</th>
                                <th>RP Beban Kerja</th>
                                <th>RP/BLN Prestasi Kerja</th>
                                <th>RP Prestasi Kerja</th>
                                <th>TOTAL/BLN/ALL TPP</th>
                                <th>TOTAL/THN/ALL TPP</th>
                            </tr>
                        </thead>
                        @php 
                        $rumus_bk_tahunan_total = 0;
                        $rumus_bk_bulanan_total = 0;
                        $rumus_pk_tahunan_total = 0;
                        $rumus_pk_bulanan_total = 0;
                        $rumus_total_tpp_bulanan_total = 0;
                        $rumus_total_tpp_tahunan_total = 0;
                        @endphp 
                        <tbody id="dynamic-row">
                                @foreach ($datas as $i => $data)
                                @php
                                    $nilai_jabatan = 0;
                                    $indeks = 0;

                                    if ($data->subkoor == "Subkoor") {
                                        $nilai_jabatan = ($data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            ? (float) $data->nilai_jabatan_subkor_non_penyetaraan
                                            : (float) $data->nilai_jabatan_subkor_penyetaraan;

                                        $indeks = ($data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            ? (float) $data->indeks_subkor_non_penyetaraan
                                            : (float) $data->indeks_subkor_penyetaraan;
                                    } elseif ($data->subkoor == "Koor") {
                                        $nilai_jabatan = ($data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            ? (float) $data->nilai_jabatan_koor_non_penyetaraan
                                            : (float) $data->nilai_jabatan_koor_penyetaraan;

                                        $indeks = ($data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            ? (float) $data->indeks_koor_non_penyetaraan
                                            : (float) $data->indeks_koor_penyetaraan;
                                    } else {
                                        $nilai_jabatan = (float) $data->nilai_jabatan;
                                        $indeks = (float) $data->indeks;
                                    }

                                    $bulan_bk = (float)($data->bulan_bk ?? 0);
                                    $bulan_pk = (float)($data->bulan_pk ?? 0);
                                    $rumus_bk_tahunan = 0;
                                    $rumus_bk_bulanan = 0;
                                    $rumus_pk_tahunan = 0;
                                    $rumus_pk_bulanan = 0;
                                    $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
                                    $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
                                    $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
                                    $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();

                                    
                                    // bk
                                    $bk = \App\Models\Rupiah::bk();
                                    $rumus_bk_bulanan = ($nilai_jabatan ?? 0) * ($indeks ?? 0 ) * $bk;
                                    $rumus_bk_tahunan = $rumus_bk_bulanan * $bulan_bk;

                                
                                    // pk
                                    if ($data->opd_id == 5) {
                                        $pk = \App\Models\Rupiah::pk();
                                        $rumus_pk_bulanan = ($nilai_jabatan ?? 0) * ($indeks ?? 0 ) * $pk * 0;
                                        $rumus_pk_tahunan = $rumus_pk_bulanan * $bulan_pk;
                                    } else {
                                        $pk = \App\Models\Rupiah::pk();
                                        $rumus_pk_bulanan = ($nilai_jabatan ?? 0) * ($indeks ?? 0 ) * $pk;
                                        $rumus_pk_tahunan = $rumus_pk_bulanan * $bulan_pk;
                                    }
                                    

                                    // total
                                    $rumus_total_tpp_bulanan = 0;
                                    $rumus_total_tpp_tahunan = 0;
                                    if ($data->guru_nonguru == "guru") {
                                        if ($data->sertifikasi_guru == "Sudah Sertifikasi") {
                                            $rumus_total_tpp_bulanan = $tpp_guru_sertifikasi;
                                            $rumus_total_tpp_tahunan = $rumus_total_tpp_bulanan * $bulan_bk;
                                        } elseif ($data->sertifikasi_guru == "Belum Sertifikasi") {
                                            $rumus_total_tpp_bulanan = $tpp_guru_belum_sertifikasi;
                                            $rumus_total_tpp_tahunan = $rumus_total_tpp_bulanan * $bulan_bk;
                                        } else {
                                            $rumus_total_tpp_bulanan == null;
                                            $rumus_total_tpp_tahunan == null;
                                        }
                                    } elseif ($data->sts_pegawai == "PENGAWAS SEKOLAH") {
                                        $rumus_total_tpp_bulanan = $tpp_pengawas_sekolah;
                                        $rumus_total_tpp_tahunan = $rumus_total_tpp_bulanan * $bulan_bk;
                                    } elseif ($data->sts_pegawai == "KEPALA SEKOLAH") {
                                        $rumus_total_tpp_bulanan = $tpp_kepala_sekolah;
                                        $rumus_total_tpp_tahunan = $rumus_total_tpp_bulanan * $bulan_bk;
                                    } else {
                                        $rumus_total_tpp_bulanan = $rumus_bk_bulanan + $rumus_pk_bulanan;
                                        $rumus_total_tpp_tahunan = $rumus_bk_tahunan + $rumus_pk_tahunan;
                                    }

                                    $rumus_bk_tahunan_total += $rumus_bk_tahunan;
                                    $rumus_bk_bulanan_total += $rumus_bk_bulanan;
                                    $rumus_pk_tahunan_total += $rumus_pk_tahunan;
                                    $rumus_pk_bulanan_total += $rumus_pk_bulanan;
                                    $rumus_total_tpp_bulanan_total += $rumus_total_tpp_bulanan;
                                    $rumus_total_tpp_tahunan_total += $rumus_total_tpp_tahunan;
                                @endphp
                                <tr>
                                    <td>{{ $i + 1 + ($datas->currentPage() - 1) * $datas->perPage() }}</td>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->nama_pegawai }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td>{{ $data->sts_pegawai }}</td>
                                    <td>{{ $data->nama_jabatan }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' || $data->subkoor == 'Koor')
                                            {{ $data->nama_subkoor }}
                                        @else
                                            {{ $data->nama_jabatan }}
                                        @endif
                                    </td>
                                    <td>{{ $data->jenis_jabatan}}</td>
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
                                    <td>{{ $data->kelas_jabatan }}</td>
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
                                    <td>{{ $data->nilai_jabatan }}</td>
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
                                    <td>{{ $data->indeks }}</td>
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
                                    <td>{{ $data->bulan_bk}}</td>
                                    <td>{{ $data->bulan_pk}}</td>
                                    @if ($data->sts_pegawai == 'GURU'){
                                        @if ($data->sertifikasi_guru == "Belum Sertifikasi")
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                        @elseif ($data->sertifikasi_guru == "Sudah Sertifikasi")
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>  
                                        @else
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>
                                            <td>0</td>  
                                        @endif
                                    } @elseif ($data->sts_pegawai == 'PENGAWAS SEKOLAH') {
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    } @elseif ($data->sts_pegawai == 'KEPALA SEKOLAH') {
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    } @else {
                                        <td>{{ number_format($rumus_bk_bulanan, 0, ',', '.') }}</td>
                                        <td>{{ number_format($rumus_bk_tahunan, 0, ',', '.') }}</td>
                                        <td>{{ number_format($rumus_pk_bulanan, 0, ',', '.') }}</td>
                                        <td>{{ number_format($rumus_pk_tahunan, 0, ',', '.') }}</td>
                                    }
                                    @endif
                                    <td>{{ number_format($rumus_total_tpp_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rumus_total_tpp_tahunan, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>{{ number_format($rumus_bk_tahunan_total,0,',','.') }}</td>
                                <td>{{ number_format($rumus_bk_bulanan_total,0,',','.') }}</td>
                                <td>{{ number_format($rumus_pk_tahunan_total,0,',','.') }}</td>
                                <td>{{ number_format($rumus_pk_bulanan_total,0,',','.') }}</td>
                                <td>{{ number_format($rumus_total_tpp_bulanan_total,0,',','.') }}</td>
                                <td>{{ number_format($rumus_total_tpp_tahunan_total,0,',','.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-center">
                
                {{-- {!! $pegbul->render() !!} --}}
                {{ $datas->appends([
                    'search' => $search,
                    'filteropd' => $filteropd,
                    'pagination' => $pagination,
                    'filtersubopd' => $filtersubopd,
                    ])->links() }}
            </div>
        </div>
    </div>
@endsection
