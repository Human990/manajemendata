@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        @if(!session()->get('tahun_id_session'))
            <h5 class="card-title; blinking-text">Silahkan pilih tahun lalu klik tombol aktifkan diatas!</h5>
        @endif
    </div>

    <div class="container-fluid">
        @if($catatans->total() >= 1)
        <div class="card card-headline">
            <div class="card-header">
                <h5 class="card-title">
                    <b>Catatan OPD <b style="color:Red">( {{ $catatans->total() }} Catatan perlu tindak lanjut )</b></b> 
                </h5>
            </div>
        </div></br>
        @endif

        @if(session()->get('tahun_id_session'))

        <div class="card card-headline">
            <div class="card-header">
                <h5 class="card-title"><b>Rekap Anggaran Tahun {{ session()->get('tahun_session') }}</b></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <canvas id="tppChart" width="400" height="200" style="max-width: 150%; height: auto;"></canvas>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <caption
                            style="caption-side: top; text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 10px; margin-top: 20px;">
                            Tabel Perbandingan</caption>
                        <thead style="color: black; background-color: #C5F04A;">
                            <tr>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>APBD</b></th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>BELANJA PEGAWAI</b></th>
                                <th rowspan="2" style="text-align: center; vertical-align: middle;"><b>RAPBD</b></th>
                                <th colspan="5" style="text-align: center; vertical-align: middle;"><b>PERHITUNGAN APLIKASI TPP 2024</b></th>
                            </tr>
                            <tr>
                                <th style="text-align: center; vertical-align: middle;">TPP BK + PK</th>
                                <th style="text-align: center; vertical-align: middle;">TPP Penjabaran</th>
                                <th style="text-align: center; vertical-align: middle;">TPP POL</th>
                                <th style="text-align: center; vertical-align: middle;">TPP KELANGKAAN PROFESI</th>
                                <th style="text-align: center; vertical-align: middle;">TOTAL PERHITUNGAN TPP</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            
                        </tbody>
                        <tfoot style="color: black;">
                            <tr>
                                <td>
                                    {{ number_format($rupiah3->jumlah, 0) }}
                                </td>
                                <td>
                                    {{ number_format($rupiah4->jumlah, 0) }}
                                </td>
                                <td>
                                    {{ number_format($rupiah5->jumlah, 0) }}
                                </td>
                                <td>
                                    {{ number_format($total_all_tpp, 0) }}
                                </td>
                                <td>
                                    {{ number_format(($tot_all_beban_kerja + $tot_all_prestasi_kerja), 0) }}
                                </td>
                                <td>
                                    {{ number_format($tpp_pol, 0) }}
                                </td>
                                <td>
                                    {{ number_format($tpp_kelangkaan_profesi, 0) }}
                                </td>
                                <td>
                                    {{ number_format($overall_tpp, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>

                    <table class="table table-hover table-bordered">
                        <thead style="color: black; background-color: #00FFFF;">
                            <tr>
                                <td><b>URAIAN</b></td>
                                <td><b>TPP TAHUN 2023</b></td>
                                <td><b>TPP TAHUN 2024</b></td>
                                <td><b>SELISIH</b></td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Tambahan Penghasilan berdasarkan Beban Kerja ASN</b></td>
                                <td>{{ number_format ($tpp_bk_2023,0)}}</td>
                                <td>{{ number_format ($total_tpp_bk,0)}}</td>
                                <td>{{ number_format($total_tpp_bk - $tpp_bk_2023,0) }}</td>
                            </tr>
                            <tr>
                                <td><b>Tambahan Penghasilan berdasarkan Kelangkaan Profesi ASN</b></td>
                                <td>{{ number_format ($tpp_kelangkaan_profesi_2023,0)}}</td>
                                <td>{{ number_format ($tpp_kelangkaan_profesi,0)}}</td>
                                <td>{{ number_format($tpp_kelangkaan_profesi - $tpp_kelangkaan_profesi_2023,0) }}</td>
                            </tr>
                            <tr>
                                <td><b>Tambahan Penghasilan berdasarkan Prestasi Kerja ASN</b></td>
                                <td>{{ number_format ($tpp_pk_2023,0)}}</td>
                                <td>{{ number_format ($total_tpp_pk,0)}}</td>
                                <td>{{ number_format($total_tpp_pk - $tpp_pk_2023 ,0) }}</td>
                            </tr>
                            <tr>
                                <td><b>Tambahan Penghasilan berdasarkan Pertimbangan Objektif Lainnya ASN</b></td>
                                <td>{{ number_format ($tpp_pol_2023,0)}}</td>
                                <td>{{ number_format ($tpp_pol,0)}}</td>
                                <td>{{ number_format($tpp_pol - $tpp_pol_2023,0) }}</td>
                            </tr>
                            <tr>
                                <td><b>TOTAL</b></td>
                                <td>{{ number_format ($tpp_bk_2023 + $tpp_kelangkaan_profesi_2023 + $tpp_pk_2023 + $tpp_pol_2023,0)}}</td>
                                <td>{{ number_format ($total_tpp_bk + $tpp_kelangkaan_profesi + $total_tpp_pk + $tpp_pol,0)}}</td>
                                <td>{{ number_format(($total_tpp_bk + $tpp_kelangkaan_profesi + $total_tpp_pk + $tpp_pol) - ($tpp_bk_2023 + $tpp_kelangkaan_profesi_2023 + $tpp_pk_2023 + $tpp_pol_2023)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-center mt-5">
                    {{-- Display percentage calculation --}}
                    <h5 style="color:black;">Presentase Belanja Pegawai =
                        {{ number_format(($rupiah4->jumlah / $rupiah3->jumlah) * 100, 2) }}%</h5>
                    <h5 style="color:black;">Presentase TPP dari Presentase Belanja Pegawai =
                        {{-- rumus presentase disini --}}
                        {{ number_format(($overall_tpp / $rupiah4->jumlah) * ($rupiah4->jumlah / $rupiah3->jumlah) * 100, 2) }}%
                    </h5>
                </div>
            </div>
        </div>

        <div class="card card-headline mt-5">
            <div class="card-header">
                <h5 class="card-title"><b>Data Pegawai</b></h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <td colspan="2" style="color:green;"> <b>JUMLAH PEGAWAI</b> </td>
                            <td colspan="2" style="color:green;"> <b>ANGGARAN RABPD (Minus RSUD)</b> </td>
                        </tr>
                        <tr>
                            <td style="color:black;"><b>Jumlah pegawai:</b></td>
                            <td style="color:red;">{{ number_format($jumlah_pegawai, 0) }} orang</td>
                            <td style="color:black;">Total TPP Pegawai (minus RSUD):</td>
                            <td style="color:blue;">{{ number_format($total_all_tpp, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:purple;">Jumlah pegawai Guru:</td>
                            <td style="color:orange;">{{ number_format($jumlah_pegawai_guru, 0) }} orang</td>
                            <td style="color:purple;">Total TPP Pegawai Guru:</td>
                            <td style="color:orange;">{{ number_format($total_tpp_guru, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:purple;">Jumlah pegawai Non Guru:</td>
                            <td style="color:orange;">{{ number_format($jumlah_pegawai_non_guru, 0) }} orang</td>
                            <td style="color:purple;">Total TPP Pegawai Non Guru:</td>
                            <td style="color:orange;">{{ number_format($total_tpp_non_guru, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah Guru Sudah Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($jumlah_guru_sertifikasi, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP Guru Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($total_tpp_guru_sertifikasi, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah Guru Belum Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($jumlah_guru_belum_sertifikasi, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP Guru Belum Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($total_tpp_guru_belum_sertifikasi, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah Pengawas Sekolah:</td>
                            <td style="color:red;">{{ number_format($jumlah_pengawas_sekolah, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP Pengawas Sekolah:</td>
                            <td style="color:red;">{{ number_format($total_tpp_pengawas_sekolah, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah Kepala Sekolah:</td>
                            <td style="color:red;">{{ number_format($jumlah_kepala_sekolah, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP Kepala Sekolah:</td>
                            <td style="color:red;">{{ number_format($total_tpp_kepala_sekolah, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah pppk Guru Sudah Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($pppk_guru_sertifikasi, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP PPPK GURU Sudah Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($tpp_pppk_sertifikasi, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah pppk Guru Belum Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($pppk_guru_belum_sertifikasi, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP PPPK GURU Belum Sertifikasi:</td>
                            <td style="color:red;">{{ number_format($tpp_pppk_belum_sertifikasi, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah pppk Non Guru:</td>
                            <td style="color:red;">{{ number_format($pppk_nonguru, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP PPPK NON GURU:</td>
                            <td style="color:red;">{{ number_format($tpp_pppk, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah pppk Guru:</td>
                            <td style="color:red;">{{ number_format($pppk_guru, 0) }} orang</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah Pensiun:</td>
                            <td style="color:red;"><a href="{{ route('adminkota-pensiun') }}">{{ number_format($jumlah_pensiun, 0) }} orang</a></td>
                            <td colspan="2" style="color:green;"> <b>ANGGARAN TPP RSUD </b></td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah RSUD:</td>
                            <td style="color:red;">{{ number_format($rs, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP RSUD:</td>
                            <td style="color:red;">{{ number_format($tpp_rsud, 0) }}</td>
                        </tr>
                        <tr>
                            <td style="color:black;">Jumlah PPPK RSUD:</td>
                            <td style="color:red;">{{ number_format($pppk_rs, 0) }} orang</td>
                            <td style="color:black;">Jumlah TPP PPPK RSUD:</td>
                            <td style="color:red;">{{ number_format($tpp_pppk_rsud, 0) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-center">
                    {{-- <h6>jumlah data :{{$jumlah_pegbul}}</h6> --}}
                </div>
            </div>
        </div>
        

        @endif
    </div>

    @if(session()->get('tahun_id_session'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('tppChart').getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['APBD', 'BELANJA PEGAWAI', 'RAPBD' ,'PERHITUNGAN APLIKASI TPP 2024'],
                        datasets: [{
                            label: 'Total Per Tahun',
                            data: [
                                {{ $rupiah3->jumlah }},
                                {{ $rupiah4->jumlah }},
                                {{ $rupiah5->jumlah }},
                                {{ $overall_tpp }}, //nanti ambil dari $total_tpp
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            document.getElementById('button_catatan_opd').addEventListener('click', function () {
                var table = document.getElementById('catatan_opd');
                var button = document.getElementById('button_catatan_opd');

                if (table.style.display === 'none' || table.style.display === '') {
                    table.style.display = 'table';
                    button.textContent = 'Sembunyikan Daftar';
                } else {
                    table.style.display = 'none';
                    button.textContent = 'Tampilkan Daftar';
                }
            });
        </script>
    @endif
@endsection
