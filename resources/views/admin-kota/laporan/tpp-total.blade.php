@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title"><b>Rekap TPP</b>/All OPD</h3>
        </div>
        <div class="card-body">
            {{-- <a href="{{route('tpp-pegawai')}}" class="btn btn-warning">Back</a> --}}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Perangkat Daerah</th>
                            <th>Jumlah Pegawai</th>
                            <th>Total TPP</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @php 
                            $totalPegawaiOverall = 0;
                            $totalTppOverall = 0;
                            $totalPegawaiPerOpd = [];
                            $totalTppPerOpd = [];

                            // Loop through each pegawai to calculate total pegawai and total tpp per OPD
                            foreach ($pegawais as $pegawai) {
                                $totalPegawaiOverall = $pegawai->where('tahun_id',session()->get('tahun_id_session'))->count(); // Hitung jumlah pegawai secara keseluruhan
                                $nilai_jabatan = 0;
                                $indeks = 0;
                                if ($pegawai->subkoor == "Subkoor") {
                                        $nilai_jabatan = ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            ? (float) $pegawai->nilai_jabatan_subkor_non_penyetaraan
                                            : (float) $pegawai->nilai_jabatan_subkor_penyetaraan;

                                        $indeks = ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            ? (float) $pegawai->indeks_subkor_non_penyetaraan
                                            : (float) $pegawai->indeks_subkor_penyetaraan;
                                    } elseif ($pegawai->subkoor == "Koor") {
                                        $nilai_jabatan = ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            ? (float) $pegawai->nilai_jabatan_koor_non_penyetaraan
                                            : (float) $pegawai->nilai_jabatan_koor_penyetaraan;

                                        $indeks = ($pegawai->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            ? (float) $pegawai->indeks_koor_non_penyetaraan
                                            : (float) $pegawai->indeks_koor_penyetaraan;
                                    } else {
                                        $nilai_jabatan = (float) $pegawai->nilai_jabatan;
                                        $indeks = (float) $pegawai->indeks;
                                    }

                                // Rest of your calculation remains the same
                                $bk = \App\Models\Rupiah::bk();
                                $pk = \App\Models\Rupiah::pk();
                                $tppPerOpd = 0;
                                $bulan_bk = (float)($pegawai->bulan_bk ?? 0);
                                $bulan_pk = (float)($pegawai->bulan_pk ?? 0);
                                // $tpp_guru_sertifikasi = \App\Models\Rupiah::tppGuruSertifikasi();
                                // $tpp_guru_belum_sertifikasi = \App\Models\Rupiah::tppGuruBelumSertifikasi();
                                // $tpp_pengawas_sekolah = \App\Models\Rupiah::tppPengawasSekolah();
                                // $tpp_kepala_sekolah = \App\Models\Rupiah::tppKepalaSekolah();

                                // Hitung total_tpp untuk pegawai saat ini
                                $tppPerOpd = (($nilai_jabatan * $indeks * $bk) * $bulan_bk) + (($nilai_jabatan * $indeks * $pk) * $bulan_pk);
                            
                                if ($pegawai->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan' && $pegawai->sts_koor == 'Koordinator Bukan Hasil Penyetaraan') {
                                    $tppPerOpd *= 0.85; // 85% adjustment
                                } else {
                                    $tppPerOpd *= 1.00; // 100% adjustment
                                }

                                $opdNama = $pegawai->nama_opd;
                                $totalPegawaiPerOpd[$opdNama] = ($totalPegawaiPerOpd[$opdNama] ?? 0) + 1;
                                $totalTppPerOpd[$opdNama] = ($totalTppPerOpd[$opdNama] ?? 0) + $tppPerOpd;

                                $totalPegawaiOverall += 0;
                                $totalTppOverall += $tppPerOpd;
                            }        

                            @endphp
                            @foreach($opds as $opd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $opd->nama_opd }}</td>
                                    <td align="center">{{ $totalPegawaiPerOpd[$opd->nama_opd] ?? 0 }}</td>
                                    <td align="right">{{ number_format($totalTppPerOpd[$opd->nama_opd] ?? 0, 0) }}</td>
                                </tr>

                            @endforeach
                        </tbody>                                             
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td align="center">{{ $totalPegawaiOverall }}</td>
                                <td align="right">{{ number_format($totalTppOverall, 0,',','.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
