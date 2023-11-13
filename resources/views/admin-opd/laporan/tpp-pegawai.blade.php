@extends('admin-opd.template.default')
@section('title', 'Data Pegawai')
@section('pegawai-bulanan', 'active')
@section('content')
<div class="container-fluid">
    @if(!session()->get('tahun_id_session'))
        <h5 class="card-title; blinking-text">Silahkan pilih tahun lalu klik tombol aktifkan diatas!</h5>
    @endif
</div>

<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Data Pegawai Tahun {{ session()->get('tahun_session') }} 
                <!-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalPegawai" style="float:right">Tambah Data</a> -->
            </h3>
        </div>
        <div class="card-body">
            <form action="{{ route('adminopd-pegawai') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari nama atau nip Pegawai . . ." name="search" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                    <div class="input-group-append">
                        <a href="{{ route('adminopd-pegawai') }}" class="btn btn-outline-secondary">Reset</a>
                    </div>
                    {{-- <div class="input-group-append">
                        <button class="btn btn-outline-secondary" data-toggle="modal" data-target="#createFilterPegawai" type="button">filter</button>
                    </div> --}}
                </div>
            </form>

            <div class="modal fade" id="createFilterPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Filter Data Pegawai</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminopd-pegawai') }}" method="GET" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="filter">Jenis Jabatan / Kelas / Indeks</label>
                                    <select type="text" name="filter" class="form-control @error('filter') is-invalid @enderror">
                                        @foreach(\App\Models\Indeks::data() as $indeks)
                                            <option value="{{ $indeks->kode_indeks }}">{{ $indeks->jenis_jabatan_baru }} / {{ $indeks->kelas_jabatan }} / {{ $indeks->indeks }}</option>
                                        @endforeach
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
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="4" checked> OPD</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="5" checked> SUB OPD</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="6" checked> Nama Jabatan</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="7" checked> Jenis Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="8" checked> Status Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="9" checked> Nilai Jabatan (JV)</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="10" checked> Indeks</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="11" checked> Pangkat</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="12" checked> Golongan</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="13" checked> Eselon</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="14" checked> Status Penerimaan TPP</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="15" checked> Sertifikasi Guru</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="16" checked> PA/KPA</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="17" checked> Sertifikasi PBJ</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="18" checked> Tipe Jabatan</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="19" checked> Subkoor</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="20" checked> Nama Subkoor</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="21" checked> Status Subkoor</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="22"> NIP Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="23"> Nama Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="24"> Nip Atasan Penilai</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="25"> Nama Atasan Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="26" checked> Pensiun</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="27" checked> Jumlah Bulan Penerimaan BK</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="28" checked> Jumlah Bulan Penerimaan PK</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="29" checked> Jumlah Bulan Penerimaan PK</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="30" checked> Tpp Tambahan</label></br>
                        </td>
                    </tr>
                </table>
                <form action="{{ route('adminopd-pegawai') }}" method="GET" class="form-inline">
                    <label for="recordsPerPage" class="mr-2">show:</label>
                    <select name="recordsPerPage" id="recordsPerPage" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="10" {{ request('recordsPerPage', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('recordsPerPage', 10) == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('recordsPerPage', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('recordsPerPage', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
                <table class="table table-hover table-bordered" id="data-table">
                    <thead>
                        <tr>
                            <th width="1%">No</th>
                            <th width="3%">NIP</th>
                            <th width="3%">Nama Pegawai</th>
                            <th width="3%">Status Pegawai</th>
                            <th width="3%">OPD</th>
                            <th width="15%">Nama Jabatan</th>
                            <th width="3%">Jenis Jabatan</th>
                            <th width="3%">Status Jabatan</th>
                            <th width="3%">Nilai Jabatan (JV)</th>
                            <th width="3%">Indeks</th>
                            <th width="3%">Pangkat</th>
                            <th width="3%">Golongan</th>
                            <th width="3%">Eselon</th>
                            <th width="3%">Status Penerimaan TPP</th>
                            <th width="3%">Sertifikasi Guru</th>
                            <th width="3%">PA/KPA</th>
                            <th width="3%">Sertifikasi PBJ</th>
                            <th width="3%">Tipe Jabatan</th>
                            <th width="3%">Subkoor</th>
                            <th width="3%">Nama Subkoor</th>
                            <th width="3%">Status Subkoor</th>
                            <th width="3%">Nip Penilai / Atasan Langsung</th>
                            <th width="3%">Nama Penilai / Atasan Langsung</th>
                            <th width="3%">Nip Atasan Penilai</th>
                            <th width="3%">Nama Atasan Penilai</th>
                            <th width="3%">Pensiun</th>
                            <th width="3%">Jumlah Bulan Penerimaan BK</th>
                            <th width="3%">Jumlah Bulan Penerimaan PK</th>
                            <th width="3%">Tpp Tambahan</th>
                            @if(\App\Models\lock::data() != '1')
                                <th width="6%">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody id="dynamic-row">
                        @php $i = 0; @endphp
                        @foreach ($datas as $data)
                        @php $i++; @endphp
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $data->nip }}</td>
                                <td>{{ $data->nama_pegawai }}</td>
                                <td>{{ $data->sts_pegawai }}</td>
                                <td>{{ $data->nama_opd }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' || $data->subkoor == 'Koor')
                                            {{ $data->nama_subkoor }}
                                        @else
                                            {{ $data->nama_jabatan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->jenis_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->jenis_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->jenis_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->jenis_koor_penyetaraan }}
                                        @else
                                            {{ $data->jenis_jabatan }}
                                        @endif
                                    </td>
                                    <td>{{ $data->sts_jabatan }}</td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_subkor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_subkor_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->nilai_jabatan_koor_penyetaraan }}
                                        @else
                                            {{ $data->nilai_jabatan }}
                                        @endif
                                    </td>
                                    <td>
                                        @if($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                            {{ $data->indeks_subkor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Subkoor' && $data->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                            {{ $data->indeks_subkor_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                            {{ $data->indeks_koor_non_penyetaraan }}
                                        @elseif($data->subkoor == 'Koor' && $data->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                            {{ $data->indeks_koor_penyetaraan }}
                                        @else
                                            {{ $data->indeks }}
                                        @endif
                                    </td>
                                <td>{{ $data->pangkat }}</td>
                                <td>{{ $data->golongan }}</td>
                                <td>{{ $data->eselon }}</td>
                                <td>{{ $data->tpp }}</td>
                                <td>{{ $data->sertifikasi_guru }}</td>
                                <td>{{ $data->pa_kpa }}</td>
                                <td>{{ $data->pbj }}</td>
                                <td>{{ $data->jft }}</td>
                                <td>{{ $data->subkoor }}</td>
                                <td>{{ $data->nama_subkoor }}</td>
                                <td>{{ $data->sts_subkoor }}</td>
                                <td>{{ $data->atasan_nip }}</td>
                                <td>{{ $data->atasan_nama }}</td>
                                <td>{{ $data->atasannya_atasan_nip }}</td>
                                <td>{{ $data->atasannya_atasan_nama }}</td>
                                <td>{{ $data->pensiun }}</td>
                                <td align="center">{{ $data->bulan_bk }}</td>
                                <td align="center">{{ $data->bulan_pk }}</td>
                                <td>{{ $data->tpp_tambahan }}</td>
                                @if(\App\Models\lock::data() != '1')
                                    <td>
                                        @if(Auth::user()->role_id == 1)
                                            <button class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ubahModalPegawai{{ $i }}"><i class="fa fa-edit"></i></button>
                                            <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i></button>
                                        @elseif(Auth::user()->role_id == 2)
                                            <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalCatatan{{ $i }}"><i class="fa fa-plus"></i> Catatan</button>

                                            <div class="modal fade" id="modalCatatan{{ $i }}" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="createModalLabel">Tambah Catatan</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form action="{{ route('adminopd-catatan.store') }}" method="post">
                                                            <div class="modal-body">
                                                                @csrf
                                                                <input type="hidden" name="pegawai_id" value="{{ $data->id }}">
                                                                <div class="form-group">
                                                                    <label for="catatan_opd">Catatan</label>
                                                                    <textarea name="catatan_opd" id="catatan_opd" cols="30" rows="7" class="form-control" placeholder="Masukkan catatan . . ."></textarea>
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
                                        @endif
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $datas->appends([
                    'search' => $search,
                    'pagination' => $pagination,
                    ])->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    function toggleColumn(columnIndex, checked) {
        const table = document.getElementById("data-table");
        const rows = table.querySelectorAll("tr");

        rows.forEach((row) => {
            const cells = row.querySelectorAll("th, td");
            if (cells.length > columnIndex) {
                const cell = cells[columnIndex];
                if (checked) {
                    cell.classList.remove("d-none");
                } else {
                    cell.classList.add("d-none");
                }
            }
        });
    }

    toggleColumn(22, false);
    toggleColumn(23, false);
    toggleColumn(24, false);
    toggleColumn(25, false);
    //toggleColumn(25, false);

    const toggleColumnCheckboxes = document.querySelectorAll(".toggle-column");

    toggleColumnCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const columnIndex = this.getAttribute("data-column");
            const isChecked = this.checked;
            toggleColumn(columnIndex, isChecked);
        });
    });

    const toggleRowCheckboxes = document.querySelectorAll(".toggle-row");

    toggleRowCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", function () {
            const row = this.parentNode.parentNode;
            const rowColumns = row.querySelectorAll("th, td");
            const isChecked = this.checked;

            rowColumns.forEach((cell, index) => {
                if (index > 0) {
                    if (isChecked) {
                        cell.classList.remove("d-none");
                    } else {
                        cell.classList.add("d-none");
                    }
                }
            });
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script>
    $('button#delete').on('click', function(e){
            e.preventDefault();

            var href = $(this).attr('href');

            Swal.fire({
                title: 'Apakah anda yakin hapus data?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                if (result.value) {
                    document.getElementById('deleteForm').action = href;
                    document.getElementById('deleteForm').submit();

                    // Swal.fire(
                    //     'Berhasil!',
                    //     'Data telah dihapus.',
                    //     'success'
                    // )
                }
            })
        })
</script>

@endsection