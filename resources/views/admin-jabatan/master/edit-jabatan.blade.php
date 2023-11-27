@extends('admin-jabatan.template.default')

@section('title', 'Edit Jabatan Lama')

@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Edit Jabatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminjabatan-jabatan.update', $datas->id) }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="nama_jabatan">Nama Jabatan</label>
                            <input type="text" name="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan"
                                placeholder="Nama Jabatan . . ." value="{{ $datas->nama_jabatan }}">
                            @error('nama_jabatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="alert alert-info" role="alert">
                            <b>JABATAN MURNI</b></br></br>
                            <div class="form-group">
                                <label for="nilai_jabatan">Nilai Jabatan</label>
                                <input type="text" name="nilai_jabatan"
                                    class="form-control @error('nilai_jabatan') is-invalid @enderror" id="nilai_jabatan"
                                    placeholder="Nilai Jabatan . . ." value="{{ $datas->nilai_jabatan }}">
                                @error('nilai_jabatan')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="indeks_id">Jenis Jabatan / Kelas / Indeks</label>
                                <select name="indeks_id" id="indeks_id" class="form-control">
                                    @foreach(\App\Models\Indeks::data() as $indeks)
                                        <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $datas->indeks_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                    @endforeach
                                </select>
                                @error('indeks_id')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="prosentase_penerimaan_murni">% Penerimaan</label>
                                <input type="number" name="prosentase_penerimaan_murni"
                                    class="form-control @error('prosentase_penerimaan_murni') is-invalid @enderror" id="prosentase_penerimaan_murni"
                                    placeholder="% Penerimaan . . ." value="{{ $datas->prosentase_penerimaan_murni }}">
                                @error('prosentase_penerimaan_murni')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tunjab">Tunjangan Jabatan Murni</label>
                            <input type="number" name="tunjab"
                                class="form-control @error('tunjab') is-invalid @enderror" id="tunjab"
                                placeholder="Tunjangan Jabatan . . ." value="{{ $datas->tunjab }}">
                            @error('tunjab')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
