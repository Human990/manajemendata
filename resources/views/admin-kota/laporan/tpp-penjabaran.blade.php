@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Penjabaran TPP Tahun {{ session()->get('tahun_session') }}</h3>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                
                                <th width="1%">No</th>
                                <th>Nama Jabatan</th>
                                <th>Unit Kerja Eselon II</th>
                                <th>Unit Kerja Eselon III</th>
                                <th>Unit Kerja Eselon IV</th>
                                <th>Jenis Jabatan</th>
                                <th>Kelas</th>
                                <th>Jumlah Pemangku</th>
                            </tr>
                        </thead>
                        @php $i=0; @endphp
                        <tbody id="dynamic-row">
                            @foreach($datas as $data)
                                @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $data->nama_jabatan }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $data->jenis_jabatan }}</td>
                                    <td>{{ $data->kelas_jabatan }}</td>
                                    <td>{{ $data->jumlah_pemangku }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
