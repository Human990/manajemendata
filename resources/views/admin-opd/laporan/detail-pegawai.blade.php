@extends('admin-opd.template.default')

@section('title', 'Detail Pegawai')

@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Detail Pegawai</b></h3>
            </div>
            <div class="card-body">
                <h4>NIP: {{ $pegawai->nip }}</h4>
                <h4>Nama: {{ $pegawai->nama_pegawai }}</h4>
                <h4>OPD: {{ $pegawai->ukor_eselon2 }}</h4>
                <h4>Pangkat: {{ $pegawai->pangkat }}</h4>
                <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
            </div>
        </div>
    </div>
@endsection
