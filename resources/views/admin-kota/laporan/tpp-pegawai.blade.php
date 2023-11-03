@extends('admin-kota.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Rekap TPP All OPD</b></h3>
            </div>
            {{-- <div class="card-body"> --}}
            {{-- <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importpegbulModal">Import</a>
            <a href="#" class="btn btn-warning">Export</a>
            <a href="#" class="btn btn-success">TPP Bulanan</a> --}}
            {{-- <a href="{{route('pegawai-bulanan')}}" class="btn btn-warning">Back</a> --}}
            {{-- <a href="{{route('tpp-total')}}" class="btn btn-info">Rekap Total TPP</a> --}}
            {{-- </div> --}}
            {{-- <div class="card-body"> --}}
            {{-- <form action="{{route('tpp-pegawai')}}" method="get">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="" class="form-label">Cari OPD</label> <br>
                            <select id="selectStatus" name="opd" class="form-control status2">
                                <option value="Dinas Pendidikan" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Pendidikan'}}">Dinas Pendidikan</option>
                                <option value="Dinas Kesehatan, Pengendalian Penduduk dan Keluarga Berencana" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Kesehatan, Pengendalian Penduduk dan Keluarga Berencana'}}">Dinas Kesehatan, Pengendalian Penduduk dan Keluarga Berencana</option>
                                <option value="Dinas Pekerjaan Umum dan Penataan Ruang" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Pekerjaan Umum dan Penataan Ruang'}}">Dinas Pekerjaan Umum dan Penataan Ruang</option>
                                <option value="Dinas Perumahan Rakyat dan Kawasan Permukiman" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Perumahan Rakyat dan Kawasan Permukiman'}}">Dinas Perumahan Rakyat dan Kawasan Permukiman</option>
                                <option value="Satuan Polisi Pamong Praja dan Pemadam Kebakaran" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran'}}">Satuan Polisi Pamong Praja dan Pemadam Kebakaran</option>
                                <option value="Badan Penanggulangan Bencana Daerah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Badan Penanggulangan Bencana Daerah'}}">Badan Penanggulangan Bencana Daerah</option>
                                <option value="Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak'}}">Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak</option>
                                <option value="Dinas Tenaga Kerja, Koperasi Usaha Kecil Dan Menengah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Tenaga Kerja, Koperasi Usaha Kecil Dan Menengah'}}">Dinas Tenaga Kerja, Koperasi Usaha Kecil Dan Menengah</option>
                                <option value="Dinas Ketahanan Pangan dan Pertanian" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Ketahanan Pangan dan Pertanian'}}">Dinas Ketahanan Pangan dan Pertanian</option>
                                <option value="Dinas Lingkungan Hidup" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Lingkungan Hidup'}}">Dinas Lingkungan Hidup</option>
                                <option value="Dinas Kependudukan dan Pencatatan Sipil" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Kependudukan dan Pencatatan Sipil'}}">Dinas Kependudukan dan Pencatatan Sipil</option>
                                <option value="Dinas Perhubungan" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Perhubungan'}}">Dinas Perhubungan</option>
                                <option value="Dinas Komunikasi dan Informatika" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Komunikasi dan Informatika'}}">Dinas Komunikasi dan Informatika</option>
                                <option value="Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'}}">Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu</option>
                                <option value="Dinas Kebudayaan, Pariwisata, Kepemudaan dan Olah Raga" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Kebudayaan, Pariwisata, Kepemudaan dan Olah Raga'}}">Dinas Kebudayaan, Pariwisata, Kepemudaan dan Olah Raga</option>
                                <option value="Dinas Perpustakaan dan Kearsipan" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Perpustakaan dan Kearsipan'}}">Dinas Perpustakaan dan Kearsipan</option>
                                <option value="Dinas Perdagangan" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Dinas Perdagangan'}}">Dinas Perdagangan</option>
                                <option value="Sekretariat Daerah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Sekretariat Daerah'}}">Sekretariat Daerah</option>
                                <option value="Sekretariat DPRD" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Sekretariat DPRD'}}">Sekretariat DPRD</option>
                                <option value="Badan Perencanaan, Penelitian dan Pengembangan Daerah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Badan Perencanaan, Penelitian dan Pengembangan Daerah'}}">Badan Perencanaan, Penelitian dan Pengembangan Daerah</option>
                                <option value="Badan Keuangan dan Aset Daerah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Badan Keuangan dan Aset Daerah'}}">Badan Keuangan dan Aset Daerah</option>
                                <option value="Badan Pendapatan Daerah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Badan Pendapatan Daerah'}}">Badan Pendapatan Daerah</option>
                                <option value="Badan Kepegawaian dan Pengembangan Sumber Daya Manusia" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia'}}">Badan Kepegawaian dan Pengembangan Sumber Daya Manusia</option>
                                <option value="Inspektorat Daerah" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Inspektorat Daerah'}}">Inspektorat Daerah</option>
                                <option value="Kecamatan Manguharjo" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Kecamatan Manguharjo'}}">Kecamatan Manguharjo</option>
                                <option value="Kecamatan Kartoharjo" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Kecamatan Kartoharjo'}}">Kecamatan Kartoharjo</option>
                                <option value="Kecamatan Taman" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Kecamatan Taman'}}">Kecamatan Taman</option>
                                <option value="Badan Kesatuan Bangsa dan Politik" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'Badan Kesatuan Bangsa dan Politik'}}">Badan Kesatuan Bangsa dan Politik</option>
                                <option value="pilih opd" selected="{{isset($_GET['opd']) && $_GET['opd'] == 'pilih opd'}}">--Pilih OPD--</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mt-4">Search</button>
                    </div>
                </div>
            </form> --}}
            {{-- <form action="{{route('tpp-pegawai')}}" method="get">
                <div class="input-group">
                    <input type="text" class="form-control" name="cari" placeholder="Ketikan nama opd..." value="{{$request->cari}}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form> --}}
            {{-- </div> --}}
            {{-- filter --}}
            {{-- <div class="card-body">
            <form action="#" method="get">
                @csrf
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <label for="" class="form-label">Tahun</label>
                        <input name="tahun" type="text" class="form-control" placeholder="tahun" value="{{isset($_GET['tahun']) ? $_GET['tahun'] : ''}}">  
                    </div>
                    <div class="col-sm-3">
                        <label for="" class="form-label">Bulan</label>
                        <input name="bulan" type="text" class="form-control" placeholder="bulan" value="{{isset($_GET['bulan']) ? $_GET['bulan'] : ''}}">  
                    </div>
                    <div class="col-sm-3">
                        <label for="" class="form-label">Unit</label>
                        <input name="unit" type="text" class="form-control" placeholder="unit" value="{{isset($_GET['unit']) ? $_GET['unit'] : ''}}">  
                    </div>
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label for="" class="form-label">Status Pegawai</label> <br>
                            <select id="selectStatus" name="status_pegawai" class="form-control status2">
                                <option value="pns" selected="{{isset($_GET['status_pegawai']) && $_GET['status_pegawai'] == 'pns'}}">PNS</option>
                                <option value="pppk" selected="{{isset($_GET['status_pegawai']) && $_GET['status_pegawai'] == 'pppk'}}">PPPK</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <button type="submit" class="btn btn-primary mt-4">Search</button>
                    </div>
                </div>
            </form>
        </div> --}}
            {{-- end filter --}}

            {{-- <div class="card-body">
            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#importModal">Import</a>
            <a href="{{route('pegawaiexport')}}" class="btn btn-warning">Export</a>
        </div> --}}
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>OPD</th>
                                <th>Kelas Jabatan</th>
                                <th>JV</th>
                                <th>Indeks</th>
                                <th>Beban Kerja Bulanan</th>
                                <th>BK Bulanan 13</th>
                                <th>Prestasi Kerja Bulanan</th>
                                <th>PK Bulanan 12</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            <?php
                            $jumlah1 = 0;
                            $jumlah2 = 0;
                            $jumlah3 = 0;
                            $jumlah4 = 0;
                            ?>
                            @foreach ($pegbul as $item)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $item->nip }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->opd }}</td>
                                    <td>{{ $item->kelas_jabatan }}</td>
                                    <td>{{ $item->jv }}</td>
                                    <td>{{ $item->indeks }}</td>
                                    <td>
                                        {{ number_format($item->jv * $item->indeks * $rupiah1->jumlah, 0) }}
                                        <?php
                                        $jumlah1 += $item->jv * $item->indeks * $rupiah1->jumlah;
                                        ?>
                                    </td>
                                    <td>
                                        {{ number_format($item->jv * $item->indeks * $rupiah1->jumlah * 13, 0) }}
                                        <?php
                                        $jumlah2 += $item->jv * $item->indeks * $rupiah1->jumlah * 13;
                                        ?>
                                    </td>
                                    <td>
                                        {{ number_format($item->jv * $item->indeks * $rupiah2->jumlah, 0) }}
                                        <?php
                                        $jumlah3 += $item->jv * $item->indeks * $rupiah2->jumlah;
                                        ?>
                                    </td>
                                    <td>
                                        {{ number_format($item->jv * $item->indeks * $rupiah2->jumlah * 12, 0) }}
                                        <?php
                                        $jumlah4 += $item->jv * $item->indeks * $rupiah2->jumlah * 12;
                                        ?>
                                    </td>
                                    {{-- <td>
                                    <a href="#" class="btn btn-sm btn-info"><i class="fa fa-eye"></i> Edit</a>
                                    <button href="#" class="btn btn-sm btn-danger" id="delete"><i class="fa fa-trash"></i> Hapus</button>
                                </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    {{ number_format($jumlah1, 0) }}
                                </td>
                                <td>
                                    {{ number_format($jumlah2, 0) }}
                                </td>
                                <td>
                                    {{ number_format($jumlah3, 0) }}
                                </td>
                                <td>
                                    {{ number_format($jumlah4, 0) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="text-center">
                <h6>jumlah data :{{ $jumlah_pegbul }}</h6>
                {{-- {!! $pegbul->render() !!} --}}
                {{-- {{ $pegbul->links() }} --}}
            </div>
            {{-- <div class="modal fade" id="importpegbulModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="importModalLabel">Import Data Pegawai Bulanan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('pegbulimportexcel')}}" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" required="required">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}
        </div>
    </div>
@endsection
