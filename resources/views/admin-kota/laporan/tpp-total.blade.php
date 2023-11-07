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
                                $tppOpdv2 = 0;
                                $tppTotalv2 = 0;
                            @endphp
                            @foreach($opds as $opd)
                            @php
                                $tppOpdv2 = isset($totalTppPerOpd[$opd->nama_opd]) ? $totalTppPerOpd[$opd->nama_opd] : 0;
                                $tppTotalv2 = $tppTotalv2 + $tppOpdv2;
                            @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $opd->nama_opd }}</td>
                                    <td align="center">{{ isset($totalPegawaiPerOpd[$opd->nama_opd]) ? $totalPegawaiPerOpd[$opd->nama_opd] : 0 }}</td>
                                    <td align="right">{{ number_format($tppOpdv2, 0, ',', '.') }}</td>
                                </tr>

                            @endforeach
                        </tbody>                                             
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td align="center">{{ $totalPegawaiOverall }}</td>
                                <td align="right">{{ number_format($tppTotalv2, 0, ',', '.') }}</td>
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
