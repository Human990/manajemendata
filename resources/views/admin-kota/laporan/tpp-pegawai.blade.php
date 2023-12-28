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
                                <th>Jenis Jabatan Murni</th>
                                <th>Kelas Jabatan Murni</th>
                                <th>Nilai Jabatan Murni</th>
                                <th>Indeks Jabatan Murni</th>
                                <th>Nama Jabatan Subkoor/Koord</th>
                                <th>Jenis Jabatan Perhitungan TPP</th>
                                <th>Kelas Jabatan Subkoor/Koord</th>
                                <th>Nilai Jabatan Subkoor/Koord</th>
                                <th>Indeks Jabatan Subkoor/Koord</th>
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
                        $jumlah_rp_tahun_bk = 0;
                        $jumlah_rp_bulan_bk = 0;
                        $jumlah_rp_tahun_pk = 0;
                        $jumlah_rp_bulan_pk = 0;
                        $total_tpp_bulanan = 0;
                        $total_tpp_tahunan = 0;
                        @endphp 
                        <tbody id="dynamic-row">
                                @foreach ($datas as $i => $data)
                                @php
                                    $nilai_jabatan = 0;
                                    $indeks = 0;
                                    $rp_bulan_bk = 0;
                                    $rp_tahun_bk = 0;
                                    $rp_bulan_pk = 0;
                                    $rp_tahun_pk = 0;
                                    $tpp_bulanan = 0;
                                    $tpp_tahunan = 0;
                                    $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
                                    $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
                                    $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
                                    $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();
                                    $bulan_bk = (float)($data->bulan_bk ?? 0);
                                    $bulan_pk = (float)($data->bulan_pk ?? 0);

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
                                    
                                   //Beban Kerja
                                    $bk = \App\Models\Rupiah::bk();
                                    if ($data->guru_nonguru == 'guru' && $data->sertifikasi_guru == 'Sudah Sertifikasi') {
                                        $rp_bulan_bk = $tpp_guru_sertifikasi;
                                    } elseif ($data->guru_nonguru == 'guru' && $data->sertifikasi_guru == 'Belum Sertifikasi') {
                                        $rp_bulan_bk = $tpp_guru_belum_sertifikasi;
                                    } elseif ($data->sts_pegawai == 'KEPALA SEKOLAH') {
                                        $rp_bulan_bk = $tpp_kepala_sekolah;
                                    } elseif ($data->sts_pegawai == 'PENGAWAS SEKOLAH') {
                                        $rp_bulan_bk = $tpp_pengawas_sekolah;
                                    } else {
                                        $rp_bulan_bk = $data->nilai_jabatan * $data->indeks * $bk;
                                    }
                                    $rp_tahun_bk = $rp_bulan_bk * $bulan_bk;

                                    //Prestasi Kerja
                                    $pk = \App\Models\Rupiah::pk();
                                    $rp_bulan_pk = ((float)$data->nilai_jabatan ?? 0) * ((float)$data->indeks ?? 0 ) * $pk;
                                    if($data->kode_opd == '5.02.0.00.0.00.03.0000'){
                                        $rp_bulan_pk = 0;
                                    }
                                    $rp_tahun_pk = $rp_bulan_pk * $bulan_pk;
                                    
                                    // Penyesuaian kondisi untuk penambahan ke total setiap iterasi
                                    $tpp_bulanan = $rp_bulan_bk + $rp_bulan_pk;
                                    $tpp_tahunan = $rp_tahun_bk + $rp_tahun_pk;
                                    $jumlah_rp_bulan_bk += $rp_bulan_bk;
                                    $jumlah_rp_tahun_bk += $rp_tahun_bk;
                                    $jumlah_rp_bulan_pk += $rp_bulan_pk;
                                    $jumlah_rp_tahun_pk += $rp_tahun_pk;
                                    $total_tpp_bulanan += $tpp_bulanan;
                                    $total_tpp_tahunan += $tpp_tahunan;
                                @endphp
                                <tr>
                                    <td>{{ $i + 1 + ($datas->currentPage() - 1) * $datas->perPage() }}</td>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->nama_pegawai }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td>{{ $data->sts_pegawai }}</td>
                                    <td>{{ $data->nama_jabatan }}</td>
                                    <td>{{ $data->jenis_jabatan}}</td>
                                    <td>{{ $data->kelas_jabatan }}</td>
                                    <td>{{ $data->nilai_jabatan }}</td>
                                    <td>{{ $data->indeks }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' || $data->subkoor == 'Koor')
                                            {{ $data->nama_subkoor }}
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
                                        @endif
                                    </td>
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
                                    <td>{{ number_format($rp_bulan_bk, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rp_tahun_bk, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rp_bulan_pk, 0, ',', '.') }}</td>
                                    <td>{{ number_format($rp_tahun_pk, 0, ',', '.') }}</td>
                                    <td>{{ number_format($tpp_bulanan, 0, ',', '.') }}</td>
                                    <td>{{ number_format($tpp_tahunan, 0, ',', '.') }}</td>

                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td colspan="16"></td>
                                <td>{{ number_format($jumlah_rp_tahun_bk,0,',','.') }}</td>
                                <td>{{ number_format($jumlah_rp_bulan_bk,0,',','.') }}</td>
                                <td>{{ number_format($jumlah_rp_tahun_pk,0,',','.') }}</td>
                                <td>{{ number_format($jumlah_rp_bulan_pk,0,',','.') }}</td>
                                <td>{{ number_format($total_tpp_bulanan,0,',','.') }}</td>
                                <td>{{ number_format($total_tpp_tahunan,0,',','.') }}</td>
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
