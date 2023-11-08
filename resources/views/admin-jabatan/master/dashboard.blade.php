@extends('admin-jabatan.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        @if(!session()->get('tahun_id_session'))
            <h3 class="card-title; blinking-text">Silahkan pilih tahun lalu klik tombol aktifkan diatas!</h3>
        @endif
    </div>
@endsection