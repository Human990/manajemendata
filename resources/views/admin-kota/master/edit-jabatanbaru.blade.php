@extends('admin-kota.template.default')

@section('title', 'Edit Jabatan Lama')

@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Edit Jabatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminkota-jabatanbaru-update', $jabatanbaru->kode_jabatanbaru) }}" method="post">
                    @csrf
                    @method('put')
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control"
                            value="{{ $jabatanbaru->nama_jabatan }}">
                    </div>
                    <div class="form-group">
                        <label for="jenis_jabatan">Jenis Jabatan</label>
                        <select name="jenis_jabatan" id="jenis_jabatan" class="form-control">
                            <option value="fungsional" {{ $jabatanbaru->jenis_jabatan === 'fungsional' ? 'selected' : '' }}>
                                Fungsional</option>
                            <option value="struktural" {{ $jabatanbaru->jenis_jabatan === 'struktural' ? 'selected' : '' }}>
                                Struktural</option>
                            <option value="pelaksana" {{ $jabatanbaru->jenis_jabatan === 'pelaksana' ? 'selected' : '' }}>
                                Pelaksana</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kelas_jabatan">Kelas Jabatan</label>
                        <input type="text" name="kelas_jabatan" class="form-control"
                            value="{{ $jabatanbaru->kelas_jabatan }}">
                    </div>
                    <div class="form-group">
                        <label for="nilai_jabatan">Nilai Jabatan</label>
                        <input type="text" name="nilai_jabatan" class="form-control"
                            value="{{ $jabatanbaru->nilai_jabatan }}">
                    </div>
                    <div class="form-group">
                        <label for="tunjab">Tunjangan Jabatan</label>
                        <input type="text" name="tunjab" class="form-control" value="{{ $jabatanbaru->tunjab }}">
                    </div>
                    <!-- Tambahkan input field lainnya sesuai kebutuhan -->
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('adminkota-jabatanbaru') }}" class="btn btn-warning">Kembali</a>
                </form>
            </div>
        </div>
    </div>
@endsection
