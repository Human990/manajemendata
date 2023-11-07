@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Rekap TPP</b>/Per Person</h3>
            </div>

            {{-- <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importModal">Import</a>
            <a href="{{route('pegawaiexport')}}" class="btn btn-warning">Export</a>
        </div> --}}
            <div class="card-body">
                <div class="row d-flex align-items-center">
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
                </div>
                                    
                <div class="filter">
                    <input type="hidden" id="opd_hidden" name="opd" value="{{ request('opd') }}">
                    <label for="opd_filter">Filter OPD:</label>
                    <select id="opd_filter" class="form-control select2">
                        <option value="">Semua OPD</option>
                        @foreach($opds as $opd)
                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                        @endforeach
                    </select>
                    <label class="mt-2" for="search">Cari:</label>
                    <input type="text" id="search" name="search" class="form-control" value="{{ request('search') }}">
                    <div class="text-center mt-2 mb-2">
                        <button class="btn btn-primary" id="filterBtn">Filter</button>
                        <a href="{{ route('adminkota-tpp-pegawai')}}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                
                                <th width="1%">No</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>OPD</th>
                                <th>Nama Jabatan</th>
                                <th>Jenis Jabatan</th>
                                <th>Kelas Jabatan</th>
                                <th>Nilai Jabatan</th>
                                <th>Indeks Jabatan</th>
                                <th>Total Bulan Penerimaan BK</th>
                                <th>Total Bulan Penerimaan PK</th>
                                <th>RP Beban Kerja</th>
                                <th>RP/BLN Beban Kerja</th>
                                <th>RP Prestasi Kerja</th>
                                <th>RP/BLN Prestasi Kerja</th>
                                <th>TOTAL/BLN/ALL JAB</th>
                                <th>TOTAL/THN/ALL JAB</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                                @php
                                    $rumus_bk_tahunan_total = 0;
                                    $rumus_bk_bulanan_total = 0;
                                    $rumus_pk_tahunan_total = 0;
                                    $rumus_pk_bulanan_total = 0;
                                    $rumus_total_tpp_bulanan_total = 0;
                                    $rumus_total_tpp_tahunan_total = 0;
                                @endphp
                                @foreach ($datas as $i => $data)
                                <tr>
                                    <td>{{ $i + 1 + ($datas->currentPage() - 1) * $datas->perPage() }}</td>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->nama_pegawai }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td>{{ $data->nama_jabatan}}</td>
                                    <td>{{ $data->jenis_jabatan}}</td>
                                    <td>{{ $data->kelas_jabatan }}</td>
                                    <td>{{ $data->nilai_jabatan }}</td>
                                    <td>{{ $data->nilai_indeks }}</td>
                                    <td>{{ $data->bulan_bk}}</td>
                                    <td>{{ $data->bulan_pk}}</td>
                                    
                                    @php
                                        $rumus_bk_tahunan = $data->nilai_jabatan * $data->nilai_indeks * $rupiah1->jumlah * $data->bulan_bk;
                                        $rumus_bk_bulanan = $data->nilai_jabatan * $data->nilai_indeks * $rupiah1->jumlah;
                                        $rumus_pk_tahunan = $data->nilai_jabatan * $data->nilai_indeks * $rupiah2->jumlah * $data->bulan_pk;
                                        $rumus_pk_bulanan = $data->nilai_jabatan * $data->nilai_indeks * $rupiah2->jumlah;
                                        $rumus_total_tpp_bulanan = $rumus_bk_bulanan + $rumus_pk_bulanan;
                                        $rumus_total_tpp_tahunan = $rumus_bk_tahunan + $rumus_pk_tahunan;
                                
                                        // Menambahkan ke total kolom
                                        $rumus_bk_tahunan_total += $rumus_bk_tahunan;
                                        $rumus_bk_bulanan_total += $rumus_bk_bulanan;
                                        $rumus_pk_tahunan_total += $rumus_pk_tahunan;
                                        $rumus_pk_bulanan_total += $rumus_pk_bulanan;
                                        $rumus_total_tpp_bulanan_total += $rumus_total_tpp_bulanan;
                                        $rumus_total_tpp_tahunan_total += $rumus_total_tpp_tahunan;
                                    @endphp
                                    <td>{{ number_format($rumus_bk_tahunan,0,',','.') }}</td>
                                    <td>{{ number_format($rumus_bk_bulanan,0,',','.') }}</td>
                                    <td>{{ number_format($rumus_pk_tahunan,0,',','.') }}</td>
                                    <td>{{ number_format($rumus_pk_bulanan,0,',','.') }}</td>
                                    <td>{{ number_format($rumus_total_tpp_bulanan,0,',','.') }}</td>
                                    <td>{{ number_format($rumus_total_tpp_tahunan,0,',','.') }}</td>
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
                {{ $datas->links() }}
            </div>
        </div>
    </div>
@endsection
