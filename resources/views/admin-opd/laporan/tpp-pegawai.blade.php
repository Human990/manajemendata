@extends('admin-opd.template.default')
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
                            Jumlah Pengganti Sementara: {{ $jumlah_pengganti_sementara }}
                        </div>
                    </div>
                </div> --}}
                                    
                <div class="filter">
                    <input type="hidden" id="opd_hidden" name="opd" value="{{ request('opd') }}">
                    <label for="opd_filter">Filter OPD:</label>
                    <select id="opd_filter" class="form-control select2">
                        <option value="">Semua OPD</option>
                        @foreach(\App\Models\Opd::where('tahun_id', session()->get('tahun_id_session'))->get() as $opd)
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
                                <th>Total Bulan Penerimaan</th>
                                <th>RP Beban Kerja</th>
                                <th>RP/BLN Beban Kerja</th>
                                <th>RP Prestasi Kerja</th>
                                <th>RP/BLN Prestasi Kerja</th>
                                <th>TOTAL/BLN/ALL JAB</th>
                                <th>TOTAL/THN/ALL JAB</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
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
                                    <td>{{ $data->total_bulan_penerimaan}}</td>
                                    <td>
                                        {{-- rumus bk btahunan --}}
                                        {{ $data->nilai_jabatan * $data->nilai_indeks * $rupiah1->jumlah * ($data->total_bulan_penerimaan + 1) }}
                                    </td>
                                    <td>
                                        {{-- rumus bk bulanan --}}
                                        {{ $data->nilai_jabatan * $data->nilai_indeks * $rupiah1->jumlah }}
                                    </td>
                                    <td>
                                        {{-- rumus pk tahunan --}}
                                        {{ $data->nilai_jabatan * $data->nilai_indeks * $rupiah2->jumlah * $data->total_bulan_penerimaan }}
                                    </td>
                                    <td>
                                        {{-- rumus pk bulanan --}}
                                        {{ $data->nilai_jabatan * $data->nilai_indeks * $rupiah2->jumlah }}
                                    </td>
                                    <td>
                                        {{-- rumus total tpp/bulan --}}
                                        {{ $data->nilai_jabatan * $data->nilai_indeks * $rupiah1->jumlah +
                                           $data->nilai_jabatan * $data->nilai_indeks * $rupiah2->jumlah }}
                                    </td>
                                    <td>
                                        {{-- rumus total tpp/tahun --}}
                                        {{ $data->nilai_jabatan * $data->nilai_indeks * $rupiah1->jumlah * ($data->total_bulan_penerimaan + 1) +
                                           $data->nilai_jabatan * $data->nilai_indeks * $rupiah2->jumlah * $data->total_bulan_penerimaan }}
                                    </td>
                                    {{-- <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Edit</a>
                                    <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button>
                                </td> --}}
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
                                <td>
                                    {{-- {{ number_format($jumlah1, 0) }} --}}
                                </td>
                                <td>
                                    {{-- {{ number_format($jumlah2, 0) }} --}}
                                </td>
                                <td>
                                    {{-- {{ number_format($jumlah3, 0) }} --}}
                                </td>
                                <td>
                                    {{-- {{ number_format($jumlah4, 0) }} --}}
                                </td>
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
