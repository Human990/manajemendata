@extends('admin-opd.template.default')
@section('title', 'Data Pegawai')
@section('pegawai-bulanan', 'active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Data Pegawai Tahun {{ session()->get('tahun_session') }} <a href="#" class="btn btn-info" data-toggle="modal" data-target="#createModalPegawai" style="float:right">Tambah Data</a></h3>
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
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-borderless">
                    <tr>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="4" checked> OPD</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="5" checked> Nama Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="6" checked> Jenis Jabatan</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="7"> Status Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="8" checked> Nilai Jabatan (JV)</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="9" checked> Indeks</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="10" checked> Pangkat</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="11" checked> Eselon</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="12"> Status Penerimaan TPP</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="13"> Sertifikasi Guru</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="14"> PA/KPA</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="15"> Sertifikasi PBJ</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="16"> Tipe Jabatan</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="17"> Subkoor</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="18"> Nama Subkoor</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="19"> Status Subkoor</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="20"> NIP Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="21"> Nama Penilai</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="22"> Nip Atasan Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="23"> Nama Atasan Penilai</label></br>
                            <label><input type="checkbox" class="toggle-column" data-column="24" checked> Jumlah Bulan Penerimaan</label></br>
                        </td>
                        <td>
                            <label><input type="checkbox" class="toggle-column" data-column="25" checked> Tpp Tambahan</label></br>
                        </td>
                    </tr>
                </table>

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
                            <th width="3%">Jumlah Bulan Penerimaan</th>
                            <th width="3%">Tpp Tambahan</th>
                            <th width="6%">Action</th>
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
                                <td>{{ $data->nama_jabatan }}</td>
                                <td>{{ $data->jenis_jabatan }}</td>
                                <td>{{ $data->sts_jabatan }}</td>
                                <td>{{ $data->nilai_jabatan }}</td>
                                <td>{{ $data->indeks }}</td>
                                <td>{{ $data->pangkat }}</td>
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
                                <td align="center">{{ $data->total_bulan_penerimaan }}</td>
                                <td>{{ $data->tpp_tambahan }}</td>
                                <td>
                                    {{-- action catatan --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $datas->appends(['search' => $search])->links() }}
            </div>
        </div>
        <div class="text-center">
            {{-- <h6>jumlah data :{{$jumlah_pegawai}}</h6> --}}
            {{ $datas->links() }}
        </div>
    </div>
</div>

</form>

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

    toggleColumn(7, false);
    toggleColumn(12, false);
    toggleColumn(13, false);
    toggleColumn(14, false);
    toggleColumn(15, false);
    toggleColumn(16, false);
    toggleColumn(17, false);
    toggleColumn(18, false);
    toggleColumn(19, false);
    toggleColumn(20, false);
    toggleColumn(21, false);
    toggleColumn(22, false);
    toggleColumn(23, false);

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

@endsection