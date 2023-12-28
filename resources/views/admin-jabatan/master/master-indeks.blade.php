@extends('admin-jabatan.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Master Indeks Tahun {{ session()->get('tahun_session') }}</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered data-table">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="15%">Tahun</th>
                            <th width="30%">Jenis Jabatan</th>
                            <th width="30%">Kelas</th>
                            <th width="15%">Indeks</th>
                            <th width="9%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{ $data->DT_RowIndex }}</td>
                            <td>{{ $data->tahun }}</td>
                            <td>{{ $data->jenis_jabatan_baru }}</td>
                            <td>{{ $data->kelas_jabatan }}</td>
                            <td>{{ $data->indeks }}</td>
                            <td>
                                <button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks{{ $data->kode_indeks }}"><i class="fa fa-eye"></i> Ubah</button>
                                {{-- <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a> --}}
                            </td>
                        </tr>

                        <!-- Modal untuk Edit -->
                        <div class="modal fade" id="ubahModalIndeks{{ $data->kode_indeks }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="createModalLabel">Ubah Master Indeks</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('adminjabatan-indeks.update', $data->kode_indeks) }}" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="jenis_jabatan">Jenis Jabatan</label>
                                                <select name="jenis_jabatan" id="jenis_jabatan" class="form-control">
                                                    @foreach(\App\Models\Jenis_jabatan::orderBy('id', 'ASC')->get() as $jenis)
                                                        <option value="{{ $jenis->id }}" @if($jenis->id == (int)$data->jenis_jabatan) selected @endif>{{ $jenis->jenis_jabatan }}</option>
                                                    @endforeach
                                                </select>
                                                @error('jenis_jabatan')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="kelas_jabatan">Kelas Jabatan</label>
                                                <input type="number" name="kelas_jabatan" class="form-control @error('kelas_jabatan') is-invalid @enderror" id="kelas_jabatan" placeholder="Kelas Jabatan . . ." value="{{ $data->kelas_jabatan }}">
                                                @error('kelas_jabatan')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="indeks">Indeks</label>
                                                <input type="text" name="indeks" class="form-control @error('indeks') is-invalid @enderror" id="indeks" placeholder="Indeks . . ." value="{{ $data->indeks }}">
                                                @error('indeks')
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
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="text/javascript">
    $(function () {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('adminjabatan-indeks') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'tahun', name: 'tahun' },
                { data: 'jenis_jabatan_baru', name: 'jenis_jabatan_baru' },
                { data: 'kelas_jabatan', name: 'kelas_jabatan' },
                { data: 'indeks', name: 'indeks' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
@endsection