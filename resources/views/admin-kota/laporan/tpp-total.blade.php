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
                            @foreach($opds as $opd)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $opd->nama_opd }}</td>
                                    <td>{{ isset($totalPegawaiPerOpd[$opd->nama_opd]) ? $totalPegawaiPerOpd[$opd->nama_opd] : 0 }}</td>
                                    <td>{{ isset($totalTppPerOpd[$opd->nama_opd]) ? $totalTppPerOpd[$opd->nama_opd] : 0 }}</td>
                                </tr>
                            @endforeach
                        </tbody>                                             
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td>{{ $totalPegawaiOverall }}</td>
                                <td>{{ $totalTppOverall }}</td>
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
