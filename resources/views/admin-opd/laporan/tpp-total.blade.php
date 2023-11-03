@extends('template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Pegawai Bulanan All OPD</b>/Rekap TPP Total</h3>
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
                                <th>Beban Kerja</th>
                                <th>Prestasi Kerja</th>
                                <th>Total BK+PK Tahunan</th>
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
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>
                                        {{ $item->ukor_eselon2 }}
                                    </td>
                                    <td>
                                        {{ number_format($item->jumlah_pegawai, 0) }}
                                        <?php
                                        $jumlahpegawai += $item->jumlah_pegawai;
                                        ?>
                                    </td>
                                    <td>
                                        {{ number_format($item->bkb_13, 0) }}
                                        <?php
                                        $jumlah2 += $item->bkb_13;
                                        ?>
                                    </td>
                                    <td>
                                        {{ number_format($item->pkb_12, 0) }}
                                        <?php
                                        $jumlah4 += $item->pkb_12;
                                        ?>
                                    </td>
                                    <td>
                                        {{ number_format($item->bkb_13 + $item->pkb_12, 0) }}
                                        <?php
                                        $jumlah6 += $item->bkb_13 + $item->pkb_12;
                                        ?>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td>{{ number_format($jumlahpegawai, 0) }}</td>
                                <td>
                                    {{ number_format($jumlah2, 0) }}
                                </td>
                                <td>
                                    {{ number_format($jumlah4, 0) }}
                                </td>
                                <td>
                                    {{ number_format($jumlah6, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-center">
                {{-- <h6>jumlah data :{{$jumlah_pegbul}}</h6> --}}
            </div>
        </div>
    </div>
@endsection
