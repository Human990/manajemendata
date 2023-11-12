@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        @if(!session()->get('tahun_id_session'))
            <h5 class="card-title; blinking-text">Silahkan pilih tahun lalu klik tombol aktifkan diatas!</h5>
        @endif
    </div>

    <div class="container-fluid">
        @if($catatans->total() >= 1)
        <div class="card card-headline">
            <div class="card-header">
                <h5 class="card-title">
                    <b>Catatan OPD <b style="color:Red">( {{ $catatans->total() }} Catatan perlu tindak lanjut )</b></b> 
                    {{-- <a href="{{ route('adminkota-catatan') }}" class="btn btn-warning" type="button" style="float:right; margin-right: 10px;"><i class="fa fa-list-ul"></i> History Catatan</a> --}}
                    {{-- <button class="btn btn-primary" type="button" style="float:right; margin-right: 10px;" id="button_catatan_opd">Tampilkan Daftar</button> --}}
                </h5>
            </div>
            {{-- <div class="card-body" id="catatan_opd" style="display:none">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead style="color: black; background-color: #ffe4a0;">
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>OPD</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Catatan OPD</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i=0; @endphp
                            @foreach($catatans as $catatan)
                            @php $i++; @endphp
                            <tr>
                                <td width="1%">{{ $i }}</td>
                                <td width="5%">{{ $catatan->tahun }}</td>
                                <td width="22%">{{ $catatan->nama_opd }}</td>
                                <td width="8%">{{ $catatan->nip }}</td>
                                <td width="16%">{{ $catatan->nama_pegawai }}</td>
                                <td width="33%">{{ $catatan->catatan_opd }}</td>
                                <td width="16%">
                                    <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalPegawai{{ $i }}"><i class="fa fa-edit"></i> Pegawai</button>
                                    <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalCatatan{{ $i }}"><i class="fa fa-plus"></i> Catatan</button>
                                </td>
                            </tr>

                                <div class="modal fade" id="modalCatatan{{ $i }}" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Catatan</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-catatan.update', $catatan->id) }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="catatan_admin">Catatan Admin Kota</label>
                                                        <textarea name="catatan_admin" id="catatan_admin" cols="30" rows="7" class="form-control" placeholder="Masukkan catatan . . .">{{ $catatan->catatan_admin }}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status">Status</label>
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="Selesai">Selesai</option>
                                                            <option value="Ditolak">Ditolak</option>
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

                                <div class="modal fade" id="modalPegawai{{ $i }}" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="createModalLabel">Ubah Data Pegawai</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('adminkota-pegawai.update', $catatan->pegawai_id) }}" method="post">
                                                <div class="modal-body">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group">
                                                        <label for="kode_opd">OPD</label>
                                                        <select name="opd_id" id="opd_id" class="form-control">
                                                            @foreach(\App\Models\Opd::orderBy('nama_opd', 'ASC')->get() as $opd)
                                                                <option value="{{ $opd->id }}" @if($catatan->opd_id == $opd->id) selected @endif>{{ $opd->nama_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nip">NIP</label>
                                                        <input type="text" name="nip"
                                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                            placeholder="NIP . . ." value="{{ $catatan->nip }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pegawai">Nama Pegawai</label>
                                                        <input type="text" name="nama_pegawai"
                                                            class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                                            placeholder="Nama Pegawai . . ." value="{{ $catatan->nama_pegawai }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pangkat">Pangkat</label>
                                                        <input type="text" name="pangkat"
                                                            class="form-control @error('pangkat') is-invalid @enderror" id="pangkat"
                                                            placeholder="Pangkat . . ." value="{{ $catatan->pangkat }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="golongan">Golongan</label>
                                                        <input type="text" name="golongan"
                                                            class="form-control @error('golongan') is-invalid @enderror" id="golongan"
                                                            placeholder="Golongan . . ." value="{{ $catatan->golongan }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eselon">Eselon</label>
                                                        <input type="text" name="eselon"
                                                            class="form-control @error('eselon') is-invalid @enderror" id="eselon"
                                                            placeholder="Eselon . . ." value="{{ $catatan->eselon }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="total_bulan_penerimaan">Jumlah Bulan Penerimaan</label>
                                                        <input type="number" name="total_bulan_penerimaan"
                                                            class="form-control @error('total_bulan_penerimaan') is-invalid @enderror" id="total_bulan_penerimaan"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="{{ $catatan->total_bulan_penerimaan }}">
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
            </div> --}}
        </div></br>
        @endif

        @if(session()->get('tahun_id_session'))

        <div class="card card-headline">
            <div class="card-header">
                <h5 class="card-title"><b>Rekap Anggaran Tahun {{ session()->get('tahun_session') }}</b></h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <canvas id="tppChart" width="400" height="200" style="max-width: 150%; height: auto;"></canvas>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <caption
                            style="caption-side: top; text-align: center; font-weight: bold; font-size: 18px; margin-bottom: 10px; margin-top: 20px;">
                            Tabel Perbandingan</caption>
                        <thead style="color: black; background-color: #C5F04A;">
                            <thead style="color: black; background-color: #C5F04A;">
                                <tr>
                                    <th>APBD</th>
                                    <th>BELANJA PEGAWAI</th>
                                    <th>TPP</th>
                                </tr>
                            </thead>
                        <tbody id="dynamic-row">
                            
                        </tbody>
                        <tfoot style="color: black;">
                            <tr>
                                <td>
                                    {{ number_format($rupiah3->jumlah, 0) }}
                                </td>
                                <td>
                                    {{ number_format($rupiah4->jumlah, 0) }}
                                </td>
                                <td>
                                    {{ number_format($total_tpp, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="text-center mt-5">
                    {{-- Display percentage calculation --}}
                    <h5 style="color:black;">Presentase Belanja Pegawai =
                        {{ number_format(($rupiah4->jumlah / $rupiah3->jumlah) * 100, 2) }}%</h5>
                    <h5 style="color:black;">Presentase TPP dari Presentase Belanja Pegawai =
                        {{-- rumus presentase disini --}}
                        {{ number_format(($total_tpp / $rupiah4->jumlah) * ($rupiah4->jumlah / $rupiah3->jumlah) * 100, 2) }}%
                    </h5>
                </div>
            </div>
        </div>

        <div class="card card-headline mt-5">
            <div class="card-header">
                <h5 class="card-title"><b>Data Pegawai</b></h5>
            </div>
            <div class="card-body">
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah pegawai : <b style="color:red;">
                            {{ number_format($jumlah_pegawai,0) }} </b>
                        orang
                    </p>
                </div>
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah guru : <b style="color:red;">
                            {{ number_format($jumlahguru,0) }} </b> orang </p>
                </div>
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah rs : <b style="color:red;"> {{ number_format($rs,0) }} </b> orang
                    </p>
                </div>
                <div class="text-left">
                    <p class="ml-3" style="color:black;">Jumlah pppk : <b style="color:red;"> {{ number_format($pppk,0) }} </b>
                        orang </p>
                </div>

                <div class="text-center">
                    {{-- <h6>jumlah data :{{$jumlah_pegbul}}</h6> --}}
                </div>
            </div>
        </div>

        @endif
    </div>

    @if(session()->get('tahun_id_session'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var ctx = document.getElementById('tppChart').getContext('2d');

                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['APBD', 'BELANJA PEGAWAI', 'TPP'],
                        datasets: [{
                            label: 'Total Per Tahun',
                            data: [
                                {{ $rupiah3->jumlah }},
                                {{ $rupiah4->jumlah }},
                                {{ $total_tpp }}, //nanti ambil dari $total_tpp
                            ],
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(255, 206, 86, 0.5)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>

        <script>
            document.getElementById('button_catatan_opd').addEventListener('click', function () {
                var table = document.getElementById('catatan_opd');
                var button = document.getElementById('button_catatan_opd');

                if (table.style.display === 'none' || table.style.display === '') {
                    table.style.display = 'table';
                    button.textContent = 'Sembunyikan Daftar';
                } else {
                    table.style.display = 'none';
                    button.textContent = 'Tampilkan Daftar';
                }
            });
        </script>
    @endif
@endsection
