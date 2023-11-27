@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">History Catatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminkota-history-catatan') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="pencarian" class="form-control " placeholder="Masukkan data yang dicari . . ." value="{{ $pencarian ?? '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-search fa-sm"></i> Pencarian
                            </button>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-outline-danger" data-toggle="modal" data-target="#createFilteropdPegawai" type="button">filter OPD</button>
                        </div>
                        <div class="input-group-append">
                            <a href="{{ route('adminkota-history-catatan') }}" class="btn btn-outline-secondary">Reset</a>
                        </div>
                    </div>
                </form></br>
                <div class="modal fade" id="createFilteropdPegawai" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createModalLabel">Filter Data Pegawai</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('adminkota-history-catatan') }}" method="GET" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="filteropd">OPD</label>
                                        <select type="text" name="filteropd" class="form-control @error('filteropd') is-invalid @enderror">
                                            @foreach(\App\Models\Opd::data() as $opd)
                                                <option value="{{ $opd->id }}">{{ $opd->nama_opd }}</option>
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
                <form action="{{ route('adminkota-history-catatan') }}" method="GET" class="form-inline">
                    <label for="recordsPerPage" class="mr-2">show:</label>
                    <select name="recordsPerPage" id="recordsPerPage" class="form-control mr-2" onchange="this.form.submit()">
                        <option value="10" {{ request('recordsPerPage', 10) == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('recordsPerPage', 10) == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('recordsPerPage', 10) == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('recordsPerPage', 10) == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead style="color: black; background-color: #ffe4a0;">
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                            
                                <!-- Informasi Pegawai -->
                                <th colspan="5" class="merged-cell">Informasi Pegawai</th>
                            
                                <!-- Informasi Jabatan -->
                                <th colspan="6" class="merged-cell">Informasi Jabatan</th>
                            
                                <!-- Informasi Tambahan -->
                                <th colspan="4" class="merged-cell">Informasi Kepangkatan</th>

                                <th colspan="4" class="merged-cell">Informasi Sertifikasi</th>
                            
                                <!-- Subkoor -->
                                <th colspan="3" class="merged-cell">Informasi Subkoor/Koordinator</th>
                            
                                <!-- Pensiun -->
                                <th colspan="4" class="merged-cell">Informasi Tambahan</th>
                            
                                <!-- Catatan -->
                                <th>Catatan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i=0; @endphp
                            @foreach($catatans as $catatan)
                            @php $i++; $no = ($catatans->currentPage() - 1) * ($catatans->perPage()) + $i; @endphp
                            <tr>
                                <td width="1%">{{ $no }}</td>
                                <td width="5%">{{ $catatan->tahun }}</td>
                                <td colspan="5" class="merged-cell">
                                    {{ $catatan->nip }} <br> 
                                    {{ $catatan->nama_pegawai }} <br> 
                                    {{ $catatan->sts_pegawai }} <br> 
                                    {{ $catatan->nama_opd }} <br> 
                                    @if ($catatan->subopd_id == null)
                                        {{ "-" }}
                                    @else
                                        {{ $catatan->nama_sub_opd }}
                                    @endif
                                </td>
                                <td colspan ="6">
                                    @if($catatan->subkoor == 'Subkoor' || $catatan->subkoor == 'Koor')
                                        {{ $catatan->nama_subkoor }}
                                    @else
                                        {{ $catatan->nama_jabatan }}
                                    @endif <br>

                                    @if($catatan->subkoor == 'Subkoor' && $catatan->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                        {{ $catatan->jenis_non_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Subkoor' && $catatan->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                        {{ $catatan->jenis_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Koor' && $catatan->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                        {{ $catatan->jenis_koor_non_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Koor' && $catatan->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                        {{ $catatan->jenis_koor_penyetaraan }}
                                    @else
                                        {{ $catatan->jenis_jabatan }}
                                    @endif <br>

                                    {{ $catatan->sts_jabatan }} <br>

                                    @if($catatan->subkoor == 'Subkoor' && $catatan->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                        {{ $catatan->nilai_jabatan_subkor_non_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Subkoor' && $catatan->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                        {{ $catatan->nilai_jabatan_subkor_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Koor' && $catatan->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                        {{ $catatan->nilai_jabatan_koor_non_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Koor' && $catatan->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                        {{ $catatan->nilai_jabatan_koor_penyetaraan }}
                                    @else
                                        {{ $catatan->nilai_jabatan }}
                                    @endif <br>

                                    @if($catatan->subkoor == 'Subkoor' && $catatan->sts_subkoor == 'Subkoordinator Bukan Hasil Penyetaraan')
                                        {{ $catatan->indeks_subkor_non_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Subkoor' && $catatan->sts_subkoor == 'Subkoordinator Hasil Penyetaraan')
                                        {{ $catatan->indeks_subkor_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Koor' && $catatan->sts_subkoor == 'Koordinator Bukan Hasil Penyetaraan')
                                        {{ $catatan->indeks_koor_non_penyetaraan }}
                                    @elseif($catatan->subkoor == 'Koor' && $catatan->sts_subkoor == 'Koordinator Hasil Penyetaraan')
                                        {{ $catatan->indeks_koor_penyetaraan }}
                                    @else
                                        {{ $catatan->indeks }}
                                    @endif <br>
                                    {{ $catatan->jft }} <br>
                                </td>

                                <td colspan="4">
                                    {{ $catatan->pangkat }} <br>
                                    {{ $catatan->golongan }} <br>
                                    {{ $catatan->eselon }} <br>
                                    {{ $catatan->tpp }} <br>
                                </td>
                                <td colspan="4">
                                    {{ $catatan->sertifikasi_guru }} <br>
                                    {{ $catatan->pa_kpa }} <br>
                                    {{ $catatan->pbj }} <br>
                                    
                                </td>

                                <td colspan="3">
                                    {{ $catatan->subkoor }} <br>
                                    {{ $catatan->nama_subkoor }} <br>
                                    {{ $catatan->sts_subkoor }} <br>
                                </td>
                                <td colspan="4">
                                    <b>Pensiun :</b>{{ $catatan->pensiun }} <br>
                                    <b>Bulan Penerimaan Beban Kerja :</b>{{ $catatan->bulan_bk }} <br>
                                    <b>Bulan Penerimaan Prestasi Kerja :</b>{{ $catatan->bulan_pk }} <br>
                                    <b>Tpp Tambahan :</b>{{ $catatan->tpp_tambahan }} <br>
                                </td>
                                <td width="32%">
                                    <b>Catatan OPD : </b>{{ $catatan->catatan_opd }}</br>
                                    @if(!empty($catatan->catatan_admin)) <b>Catatan Admin : </b>{{ $catatan->catatan_admin }} @endif
                                </td>
                                <td width="5%">{{ $catatan->status }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <span style="float:right">
                    {{ $catatans->appends([ 
                        'pencarian' => $pencarian , 
                        'pagination' => $pagination,
                        'filteropd' => $filteropd
                        ])->links() }}</span>
                </div>
            </div>
        </div>
    </div>
@endsection
