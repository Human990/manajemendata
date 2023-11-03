@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
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
                            <thead style="color: black; background-color: #C5F04A;">
                                <tr>
                                    <th>APBD</th>
                                    <th>BELANJA PEGAWAI</th>
                                    <th>TPP</th>
                                </tr>
                            </thead>
                        <tbody id="dynamic-row">
                            <?php
                            $jumlah1 = 0;
                            $jumlah2 = 0;
                            $jumlah3 = 0;
                            $jumlah4 = 0;
                            $jumlah5 = 0;
                            $jumlah6 = 0;
                            $jumlahpegawai = 0;
                            ?>
                            @foreach ($pegbul as $item)
                                <tr style="color: black;">
                                    <?php
                                    $jumlahpegawai += $item->jumlah_pegawai;
                                    ?>
                                    <?php
                                    $jumlah1 += $item->bkb;
                                    ?>
                                    <?php
                                    $jumlah2 += $item->bkb_13;
                                    ?>
                                    <?php
                                    $jumlah3 += $item->pkb;
                                    ?>
                                    <?php
                                    $jumlah4 += $item->pkb_12;
                                    ?>
                                    <?php
                                    $jumlah5 += $item->bkb + $item->pkb;
                                    ?>
                                    <?php
                                    $jumlah6 += $item->bkb_13 + $item->pkb_12;
                                    ?>
                                </tr>
                            @endforeach
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
                                    {{ number_format($jumlah6, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center mt-5">
                    {{-- Display percentage calculation --}}
                    <h5 style="color:black;">Presentase Belanja Pegawai =
                        {{ number_format(($rupiah4->jumlah / $rupiah3->jumlah) * 100, 2) }}%</h5>
                    <h5 style="color:black;">Presentase TPP dari Presentase Belanja Pegawai =
                        {{ number_format(($jumlah6 / $rupiah4->jumlah) * ($rupiah4->jumlah / $rupiah3->jumlah) * 100, 2) }}%
                    </h5>
                </div>
            </div>
        </div>
        <div class="card card-headline mt-5">
            <div class="card-header">
                <h5 class="card-title"><b>Data Pegawai</b></h5>
            </div>
            <div class="card-body">
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah pegawai : <b style="color:red;">
                            {{ number_format($jumlahpegawai, 0) }} </b>
                        orang
                    </p>
                </div>
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah guru : <b style="color:red;">
                            {{ $jumlahguru->total_guru }} </b> orang </p>
                </div>
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah rs : <b style="color:red;"> {{ $rs->total_rs }} </b> orang
                    </p>
                </div>
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah pppk : <b style="color:red;"> {{ $pppk->total_pppk }} </b>
                        orang </p>
                </div>

                <div class="text-center">
                    {{-- <h6>jumlah data :{{$jumlah_pegbul}}</h6> --}}
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('tppChart').getContext('2d');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['APBD', 'BELANJA PEGAWAI', 'TPP'],
                    datasets: [{
                        label: 'Total Per Tahun',
                        data: [
                            {{ $rupiah3->jumlah }},
                            {{ $rupiah4->jumlah }},
                            {{ $jumlah6 }},
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

@endsection
