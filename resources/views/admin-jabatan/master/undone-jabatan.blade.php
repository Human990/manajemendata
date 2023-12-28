@extends('admin-jabatan.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
<div class="container-fluid">
    <div class="card card-headline">
        <div class="card-header">
            <h3 class="card-title">Master Jabatan Tahun {{ session()->get('tahun_session') }} 
                {{-- <a href="#" style="float:right" class="btn btn-info" data-toggle="modal" data-target="#createModalIndeks">Tambah Data</a> --}}
            </h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered jabatan-table">
                    <thead>
                        <tr style="background-color:#fff0da">
                            <td width="1%" rowspan="2" align="center"><b>No</b></td>
                            <td width="24%" rowspan="2" align="center"><b>Nama Jabatan</b></td>
                            <td width="20%" colspan="5" align="center"><b>Murni</b></td>
                            <td width="7%" rowspan="2" align="center"><b>Tunjab Murni</b></td>
                            <td width="5%" rowspan="2" align="center"><b>Action</b></td>
                        </tr>
                        <tr style="background-color:#fff0da">
                            <td><b>Jenis</b></td>
                            <td><b>Kelas</b></td>
                            <td><b>Nilai</b></td>
                            <td><b>Indeks</b></td>
                            <td><b>%</b></td>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script type="text/javascript">
    $(function () {
        var table = $('.jabatan-table').DataTable({
            processing: true,
            serverSide: true,
            searchable:true,
            ajax: "{{ route('adminjabatan-jabatan.undone') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nama_jabatan', name: 'jabatans.nama_jabatan' , orderable: true, searchable: true }, // Update the column name here
                { data: 'jenis_jabatan', name: 'jenis_jabatans.jenis_jabatan' , orderable: true, searchable: true }, // Update the column name here
                { data: 'kelas_jabatan', name: 'indeks.kelas_jabatan' , orderable: true, searchable: true }, // Update the column name here
                { data: 'nilai_jabatan', name: 'jabatans.nilai_jabatan' , orderable: true, searchable: true }, // Update the column name here
                { data: 'indeks', name: 'indeks.indeks' , orderable: true, searchable: true }, // Update the column name here
                { data: 'prosentase_penerimaan_murni', name: 'jabatans.prosentase_penerimaan_murni' , orderable: true, searchable: false }, // Update the column name here
                { data: 'tunjab', name: 'jabatans.tunjab' , orderable: true, searchable: false }, // Update the column name here
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });
    });
</script>
@endpush
@endsection