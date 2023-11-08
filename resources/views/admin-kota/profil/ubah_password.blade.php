@extends('admin-kota.template.default')
@section('title', 'Master Rupiah')
@section('master-rupiah', 'active')
@section('content')
    <div class="container-fluid">
        @if (session()->has('statusY'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-warning"></i> Informasi</h4>
                        {{ session()->get('statusY') }}
                    </div>
                </div>
                {{session()->forget('statusY')}}
            </div>
        @endif

        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Ubah Password</h3>
            </div>
            
            <div class="card-body">
                <form action="{{ route('adminkota-ubahpassword') }}" method="POST">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Pengguna</label>
                            <input type="email" class="form-control" id="nama" name="nama" value="{{ $user->opd }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="email" class="form-control" id="username" name="username" value="{{ $user->username }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Lama</label>
                            <input type="password" class="form-control" id="password_lama" name="password_lama" placeholder="Masukkan Password Lama..">
                            @error('password_lama')
                                <span class="help-block" style="color:red">{{ $message }}</span>
                            @enderror

                            @if (session()->has('statusT'))
                                <span style="color:red" class="help-block">{{ session()->get('statusT') }}</span>
                                {{session()->forget('statusT')}}
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password Baru</label>
                            <input type="password" class="form-control" id="password_baru" name="password_baru" placeholder="Masukkan Password Baru..">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Konfirmasi Password</label>
                            <input type="password" class="form-control" id="konfirmasi" name="konfirmasi" placeholder="Ulangi Password Baru..">
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url()->previous() }}" class="btn btn-alt-success" type="button">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
