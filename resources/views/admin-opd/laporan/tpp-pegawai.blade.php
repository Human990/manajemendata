@extends('admin-opd.template.default')
@section('title', 'TPP Pegawai Bulanan')
@section('pegawai-bulanan', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title"><b>Rekap TPP All OPD</b></h3>
            </div>
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
                                    <td>{{ $item->nama_pegawai }}</td>
                                    <td>{{ $item->ukor_eselon2 }}</td>
                                    <td>{{ $item->jabatanbaru->kelas_jabatan }}</td>
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
        </div>
    </div>
@endsection
