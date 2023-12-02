@extends('admin-kota.template.default')
@section('title', 'Master OPD')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master OPD Tahun {{ session()->get('tahun_session') }}</h3>
            </div>
            <div class="card-body">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalIndeks">Tambah Data</a>
            </div>
            {{-- <div class="card-body">
                <form action="{{ route('adminkota-opd') }}" method="GET">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Cari nama atau nip Pegawai . . ." name="search" value="{{ request('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Cari</button>
                        </div>
                        <div class="input-group-append">
                            <a href="{{ route('adminkota-opd') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            <div class="card-body">
                <form action="{{ route('adminkota-opd') }}" method="GET" class="form-inline">
                    <label for="recordsPerPage" class="mr-2">show:</label>
                    <select name="recordsPerPage" id="recordsPerPage" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="10" {{ request('recordsPerPage', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('recordsPerPage', 10) == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('recordsPerPage', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('recordsPerPage', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
            </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-opd">
                        <thead>
                            <tr>
                                <th width="1%">No</th>
                                <th width="20%">Tahun</th>
                                <th width="20%">Kode OPD</th>
                                <th width="20%">Nama OPD</th>
                                <th width="10%">Status</th>
                                <th width="9%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            {{-- @php $i = 0; @endphp
                            @foreach ($datas as $data)
                            @php $i++; @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $data->tahun }}</td>
                                    <td>{{ $data->kode_opd }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td>{{ $data->nama_sub_opd }}</td>
                                    <td>
                                        @if(\App\Models\Lock::status($data->id) == '1')
                                            <b style="color:red">Locked</b>
                                        @else
                                            <b style="color:green">Open</b>
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-sm btn-info btn-block" data-toggle="modal" data-target="#ubahModalIndeks{{ $i }}"><i class="fa fa-eye"></i> Ubah</button>
                                        <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button>
                                    </td>
                                </tr> --}}

                                {{-- <div class="modal fade" id="ubahModalIndeks{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Master OPD</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-opd.update', $data->id) }}" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="kode_opd">Kode OPD</label>
                                                        <input type="text" name="kode_opd"
                                                            class="form-control @error('kode_opd') is-invalid @enderror" id="kode_opd"
                                                            placeholder="Kode OPD . . ." value="{{ $data->kode_opd }}">
                                                        @error('kode_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_opd">Nama OPD</label>
                                                        <input type="text" name="nama_opd"
                                                            class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                                            placeholder="Nama OPD . . ." value="{{ $data->nama_opd }}">
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subopd_id">Sub OPD</label>
                                                        <select type="text" name="subopd_id" class="form-control @error('subopd_id') is-invalid @enderror">
                                                            <option value=""  selected>--Belum Dipilih----</option>
                                                            @foreach(\App\Models\Subopd::orderBy('nama_sub_opd', 'ASC')->get() as $subopd)
                                                                <option value="{{ $subopd->id }}" @if($subopd->id == $data->subopd_id) selected @endif>{{ $subopd->nama_sub_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="lock">Kunci OPD</label>
                                                        <select type="text" name="lock" class="form-control @error('lock') is-invalid @enderror">
                                                            <option value="0" @if($data->lock == 0) selected @endif>Buka Kunci</option>
                                                            <option value="1" @if($data->lock == 1) selected @endif>Kunci</option>
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
                                </div> --}}
                            {{-- @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- <div class="text-center">
                {{ $datas->appends([
                    'search' => $search ,
                    'pagination' => $pagination, 
                ])->links() }}
            </div> --}}
            <div class="modal fade" id="createModalIndeks" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master OPD</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-opd.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                <div class="form-group">
                                    <label for="kode_opd">Kode OPD</label>
                                    <input type="text" name="kode_opd"
                                        class="form-control @error('kode_opd') is-invalid @enderror" id="kode_opd"
                                        placeholder="Kode OPD . . ." value="{{ old('kode_opd') }}">
                                    @error('kode_opd')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="form-group">
                                    <label for="opd_id">OPD</label>
                                    <select type="text" name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                        <option value="" disabled>--Belum Dipilih--</option>
                                        @foreach(\App\Models\Opd::where('tahun_id', session()->get('tahun_id_session'))->orderBy('nama_opd', 'ASC')->get() as $opd)
                                            <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="nama_opd">Nama OPD</label>
                                    <input type="text" name="nama_opd"
                                        class="form-control @error('nama_opd') is-invalid @enderror" id="nama_opd"
                                        placeholder="Nama OPD . . ." value="{{ old('nama_opd') }}">
                                    @error('nama_opd')
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
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript">
        $(function () {
            var table = $('.table-opd').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('adminkota-opd') }}",
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'tahun', name: 'master_tahun.tahun'}, // Update the column name here
                    { data: 'kode_opd', name: 'kode_opd'}, // Update the column name here
                    { data: 'nama_opd', name: 'nama_opd'}, // Update the column name here
                    { 
                        data: 'lock', 
                        name: 'lock',
                        render: function(data, type, full, meta) {
                            return (data == 1) ? 'Locked' : 'Open';
                        }
                    },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
    @endpush
@endsection
