<button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks{{ $model->id }}"><i class="fa fa-eye"></i> Ubah</button>

<!-- Modal untuk Edit -->
<div class="modal fade" id="ubahModalIndeks{{ $model->id }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Ubah Master Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('adminjabatan-jabatan.update', $model->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_jabatan">Nama Jabatan</label>
                        <input type="text" name="nama_jabatan"
                            class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan"
                            placeholder="Nama Jabatan . . ." value="{{ $model->nama_jabatan }}">
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
                                placeholder="Nilai Jabatan . . ." value="{{ $model->nilai_jabatan }}">
                            @error('nilai_jabatan')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="indeks_id">Jenis Jabatan / Kelas / Indeks</label>
                            <select name="indeks_id" id="indeks_id" class="form-control">
                                @foreach(\App\Models\Indeks::data() as $indeks)
                                    <option value="{{ $indeks->kode_indeks }}" @if($indeks->kode_indeks == $model->indeks_id) selected @endif>{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
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
                                placeholder="% Penerimaan . . ." value="{{ $model->prosentase_penerimaan_murni }}">
                            @error('prosentase_penerimaan_murni')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="tunjab">Tunjangan Jabatan Murni</label>
                        <input type="number" name="tunjab"
                            class="form-control @error('tunjab') is-invalid @enderror" id="tunjab"
                            placeholder="Tunjangan Jabatan . . ." value="{{ $model->tunjab }}">
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