@extends('template.default')
@section('title','TPP Pegawai Bulanan Terpisah')
@section('pegawai-bulanan','active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title"><b>Pegawai Bulanan All OPD</b>/Rekap TPP Total Terpisah</h3>
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
                            <th>Kepala Sekolah/Pengawas</th>
                            <th>Status Pegawai</th>
                            <th>Sertifikasi Guru</th>
                            <th>Jumlah Pegawai</th>
                            <th>BK Bulanan</th>
                            <th>BK 13 Bulan</th>
                            <th>PK Bulanan</th>
                            <th>PK 12 Bulan</th>
                            <th>Total BK+PK Bulanan</th>
                            <th>Total BK+PK Tahunan</th>
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        <?php 
                        $jumlah1=0;
                        $jumlah2=0;
                        $jumlah3=0;
                        $jumlah4=0;
                        $jumlah5=0;
                        $jumlah6=0;
                        $jumlahpegawai=0;
                        ?>
                            @foreach ($pegbul as $item)
                            <tr>
                                <td>{{++$i}}</td>
                                <td>
                                    {{$item->opd}}
                                </td>
                                <td>
                                    {{$item->ks}}
                                </td>
                                <td>
                                    {{$item->sts_pegawai}}
                                </td>
                                <td>
                                    {{$item->sertifikasi_guru}}
                                </td>
                                <td>
                                    {{number_format($item->jumlah_pegawai,0)}}
                                    <?php
                                    $jumlahpegawai += $item->jumlah_pegawai;
                                    ?>
                                </td>
                                <td>
                                    {{number_format($item->bkb,0)}}
                                    <?php
                                    $jumlah1 += $item->bkb;
                                    ?>
                                </td>
                                <td>
                                    {{number_format($item->bkb_13,0)}}
                                    <?php
                                    $jumlah2 += $item->bkb_13;
                                    ?>
                                </td>
                                <td>
                                    {{number_format($item->pkb,0)}}
                                    <?php
                                    $jumlah3 += $item->pkb;
                                    ?>
                                </td>
                                <td>
                                    {{number_format($item->pkb_12,0)}}
                                    <?php
                                    $jumlah4 += $item->pkb_12;
                                    ?>
                                </td>
                                <td>
                                    {{number_format($item->bkb+$item->pkb,0)}}
                                    <?php
                                    $jumlah5 += $item->bkb+$item->pkb;
                                    ?>
                                </td>
                                <td>
                                    {{number_format($item->bkb_13+$item->pkb_12,0)}}
                                    <?php
                                    $jumlah6 += $item->bkb_13+$item->pkb_12;
                                    ?>
                                </td>
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
                            <td>{{number_format($jumlahpegawai,0)}}</td>
                            <td>
                                {{number_format($jumlah1,0)}}
                            </td>
                            <td>
                                {{number_format($jumlah2,0)}}
                            </td>
                            <td>
                                {{number_format($jumlah3,0)}}
                            </td>
                            <td>
                                {{number_format($jumlah4,0)}}
                            </td>
                            <td>
                                {{number_format($jumlah5,0)}}
                            </td>
                            <td>
                                {{number_format($jumlah6,0)}}
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