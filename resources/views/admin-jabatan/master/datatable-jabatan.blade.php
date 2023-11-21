@extends('admin-jabatan.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Master Jabatan Tahun {{ session()->get('tahun_session') }} 
                    {{-- <a href="#" style="float:right" class="btn btn-info" data-toggle="modal" data-target="#createModalIndeks">Tambah Data</a>  --}}
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="jabatan-table">
                        <thead>
                            <tr style="background-color:#fff0da">
                                <td width="1%" rowspan="2" align="center"><b>No</b></td>
                                <td width="3%" rowspan="2" align="center"><b>Tahun</b></td>
                                <td width="24%" rowspan="2" align="center"><b>Nama Jabatan</b></td>
                                <td width="20%" colspan="5" align="center"><b>Murni</b></td>
                                <td width="20%" colspan="5" align="center"><b>Subkoordinator Hasil Penyetaraan</b></td>
                                <td width="20%" colspan="5" align="center"><b>Subkoordinator Bukan Hasil Penyetaraan</b></td>
                                <td width="20%" colspan="5" align="center"><b>Koordinator Hasil Penyetaraan</b></td>
                                <td width="20%" colspan="5" align="center"><b>Koordinator Bukan Hasil Penyetaraan</b></td>
                                <td width="7%" rowspan="2" align="center"><b>Tunjab Murni</b></td>
                                <td width="7%" rowspan="2" align="center"><b>Tunjab Subkoor</b></td>
                                <td width="7%" rowspan="2" align="center"><b>Tunjab Koor</b></td>
                                <td width="5%" rowspan="2" align="center"><b>Action</b></td>
                            </tr>
                            <tr style="background-color:#fff0da">
                                <!-- Add columns for Jenis, Kelas, Nilai, Indeks, and % for each section -->
                                <!-- Murni -->
                                <td><b>Jenis</b></td>
                                <td><b>Kelas</b></td>
                                <td><b>Nilai</b></td>
                                <td><b>Indeks</b></td>
                                <td><b>%</b></td>
                                <!-- Subkoordinator Hasil Penyetaraan -->
                                <td><b>Jenis</b></td>
                                <td><b>Kelas</b></td>
                                <td><b>Nilai</b></td>
                                <td><b>Indeks</b></td>
                                <td><b>%</b></td>
                                {{-- Subkoordinator Bukan Hasil Penyetaraan --}}
                                <td><b>Jenis</b></td>
                                <td><b>Kelas</b></td>
                                <td><b>Nilai</b></td>
                                <td><b>Indeks</b></td>
                                <td><b>%</b></td>
                                {{-- Koordinator Hasil Penyetaraan --}}
                                <td><b>Jenis</b></td>
                                <td><b>Kelas</b></td>
                                <td><b>Nilai</b></td>
                                <td><b>Indeks</b></td>
                                <td><b>%</b></td>
                                {{-- Koordinator Bukan Hasil Penyetaraan --}}
                                <td><b>Jenis</b></td>
                                <td><b>Kelas</b></td>
                                <td><b>Nilai</b></td>
                                <td><b>Indeks</b></td>
                                <td><b>%</b></td>
                                <!-- Add similar columns for other sections -->
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        $(document).ready(function () {
            $('#jabatan-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('adminjabatan-jabatan.data') }}',
                dom : 'Bfrtip',
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'tahun', name: 'tahun' },
                    { data: 'nama_jabatan', name: 'nama_jabatan' },
                    // Add columns for Jenis, Kelas, Nilai, Indeks, and % for each section
                    // Murni:
                    { data: 'jenis_jabatan', name: 'jenis_jabatan' },
                    { data: 'kelas_jabatan', name: 'kelas_jabatan' },
                    { data: 'nilai_jabatan', name: 'nilai_jabatan' },
                    { data: 'indeks', name: 'indeks' },
                    { data: 'prosentase_penerimaan_murni', name: 'prosentase_penerimaan_murni' },
                    // Subkoor Penyetaraan:
                    { data: 'jenis_penyetaraan', name: 'jenis_penyetaraan' },
                    { data: 'kelas_jabatan_subkor_penyetaraan', name: 'kelas_jabatan_subkor_penyetaraan' },
                    { data: 'nilai_jabatan_subkor_penyetaraan', name: 'nilai_jabatan_subkor_penyetaraan' },
                    { data: 'indeks_subkor_penyetaraan', name: 'indeks_subkor_penyetaraan' },
                    { data: 'prosentase_penerimaan_subkor_penyetaraan', name: 'prosentase_penerimaan_subkor_penyetaraan' },
                    // Subkoor Bukan Penyetaraan:
                    { data: 'jenis_non_penyetaraan', name: 'jenis_non_penyetaraan' },
                    { data: 'kelas_jabatan_subkor_non_penyetaraan', name: 'kelas_jabatan_subkor_non_penyetaraan' },
                    { data: 'nilai_jabatan_subkor_non_penyetaraan', name: 'nilai_jabatan_subkor_non_penyetaraan' },
                    { data: 'indeks_subkor_non_penyetaraan', name: 'indeks_subkor_non_penyetaraan' },
                    { data: 'prosentase_penerimaan_subkor_non_penyetaraan', name: 'prosentase_penerimaan_subkor_non_penyetaraan' },
                    // Koor Penyetaraan:
                    { data: 'jenis_koor_penyetaraan', name: 'jenis_koor_penyetaraan' },
                    { data: 'kelas_jabatan_koor_penyetaraan', name: 'kelas_jabatan_koor_penyetaraan' },
                    { data: 'nilai_jabatan_koor_penyetaraan', name: 'nilai_jabatan_koor_penyetaraan' },
                    { data: 'indeks_koor_penyetaraan', name: 'indeks_koor_penyetaraan' },
                    { data: 'prosentase_penerimaan_koor_penyetaraan', name: 'prosentase_penerimaan_koor_penyetaraan' },
                    // Koor Bukan Penyetaraan:
                    { data: 'jenis_koor_non_penyetaraan', name: 'jenis_koor_non_penyetaraan' },
                    { data: 'kelas_jabatan_koor_non_penyetaraan', name: 'kelas_jabatan_koor_non_penyetaraan' },
                    { data: 'nilai_jabatan_koor_non_penyetaraan', name: 'nilai_jabatan_koor_non_penyetaraan' },
                    { data: 'indeks_koor_non_penyetaraan', name: 'indeks_koor_non_penyetaraan' },
                    { data: 'prosentase_penerimaan_koor_non_penyetaraan', name: 'prosentase_penerimaan_koor_non_penyetaraan' },
                    // Add similar columns for other sections
                    { data: 'tunjab', name: 'tunjab' },
                    { data: 'tunjab_subkor', name: 'tunjab_subkor' },
                    { data: 'tunjab_koor', name: 'tunjab_koor' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });
    </script>
    @endpush
@endsection