<button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks{{ $model->id }}"><i class="fa fa-eye"></i> Ubah</button>


<div class="modal fade" id="ubahModalIndeks{{ $model->id }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Ubah Master OPD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('adminkota-opd.update', $model->id) }}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="kode_opd">Kode OPD</label>
                        <input type="text" name="kode_opd"
                            class="form-control @error('kode_opd') is-invalid @enderror" id="kode_opd"
                            placeholder="Kode OPD . . ." value="{{ $model->kode_opd }}">
                        @error('kode_opd')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama_opd">Nama OPD</label>
                        <input type="text" name="nama_opd"
                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                            placeholder="Nama OPD . . ." value="{{ $model->nama_opd }}">
                        @error('nama_opd')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="lock">Kunci OPD</label>
                        <select type="text" name="lock" class="form-control @error('lock') is-invalid @enderror">
                            <option value="0" @if($model->lock == 0) selected @endif>Buka Kunci</option>
                            <option value="1" @if($model->lock == 1) selected @endif>Kunci</option>
                        </select>
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