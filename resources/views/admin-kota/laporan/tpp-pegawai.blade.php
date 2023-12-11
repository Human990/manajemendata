@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Rekap TPP</b>/Per Person {{ session()->get('tahun_session') }}</h3>
            </div>
            <div class="card-body">
                <div class="card-body">
                    <form action="{{ route('adminkota-tpp-pegawai') }}" method="GET">
                        @csrf
                    
                        <!-- Bagian Pencarian -->
                        <div>
                            <label for="search">Cari:</label>
                            <input class="form-control" type="text" name="search" value="{{ $search ?? '' }}">
                        </div>
                    
                        <!-- Bagian Filter OPD -->
                        <div>
                            <label for="filteropd">Filter OPD:</label>
                            <select name="filteropd" class="form-control @error('filteropd') is-invalid @enderror">
                                <option value="">Semua OPD</option>
                                @foreach(\App\Models\Opd::data()->get() as $opd)
                                    <option value="{{ $opd->id }}" {{ $filteropd == $opd->id ? 'selected' : '' }}>
                                        {{ $opd->nama_opd }}
                                    </option>
                                @endforeach
                            </select>
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
                            <button class="btn btn-sm btn-info mt-2" type="submit">Submit</button>
                            <a href="{{ route('adminkota-tpp-pegawai')}}" class="btn btn-sm btn-warning mt-2">reset</a>
                        </div>
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
                        <tbody id="dynamic-row">
                                @foreach ($datas as $i => $data)
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
                                        @endif
                                    </td>
                                    <td>{{ $data->bulan_bk}}</td>
                                    <td>{{ $data->bulan_pk}}</td>
                                    <td>{{ number_format($rumus_bk_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rumus_bk_tahunan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rumus_pk_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rumus_pk_tahunan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rumus_total_tpp_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rumus_total_tpp_tahunan, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td colspan="16"></td>
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
                {{ $datas->appends([
                    'search' => $search,
                    'filteropd' => $filteropd,
                    'recordsPerPage' => $pagination,
                ])->links() }}
            </div>
        </div>
    </div>
@endsection
