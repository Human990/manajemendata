                <?php
                    header ( "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" );
                    header ( "Content-Disposition: attachment; filename=Penjabaran TPP $datetime.xls" );
                ?>

                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                
                                <th width="1%">No</th>
                                <th width="12%">Nama Jabatan</th>
                                <th width="12%">Unit Kerja Eselon II</th>
                                <th>Unit Kerja Eselon III</th>
                                <th>Unit Kerja Eselon IV</th>
                                <th>Jenis Jabatan</th>
                                <th>Kelas</th>
                                <th>Jumlah Pemangku</th>
                                <th>Basic TPP</th>

                                <!-- Beban Kerja -->
                                <th>Jenis Evidence Beban Kerja</th>
                                <th>% Beban Kerja</th>
                                <th>RP Beban Kerja</th>
                                <th>RP/BLN Beban Kerja</th>

                                <!-- Prestasi Kerja -->
                                <th>Jenis Evidence Prestasi Kerja</th>
                                <th>% Prestasi Kerja</th>
                                <th>RP Prestasi Kerja</th>
                                <th>RP/BLN Prestasi Kerja</th>
                                
                                <!-- Kondisi Kerja -->
                                <th>Jenis Evidence Kondisi Kerja</th>
                                <th>% Kondisi Kerja</th>
                                <th>RP Kondisi Kerja</th>
                                <th>RP/BLN Kondisi Kerja</th>
                                
                                <!-- Tempat Bertugas -->
                                <th>Jenis Evidence Tempat Bertugas</th>
                                <th>% Tempat Bertugas</th>
                                <th>RP Tempat Bertugas</th>
                                <th>RP/BLN Tempat Bertugas</th>
                                
                                <!-- Kelangkaan Profesi -->
                                <th>Jenis Evidence Kelangkaan Profesi</th>
                                <th>% Kelangkaan Profesi</th>
                                <th>RP Kelangkaan Profesi</th>
                                <th>RP/BLN Kelangkaan Profesi</th>

                                <th>RP POL Belanja Insentif ASN atas Pemungutan Pajak Daerah</th>
                                <th>RP POL Belanja bagi ASN atas Insentif Pemungutan Restribusi Daerah</th>
                                <th>RP POL Belanja Jasa Pelayanan Kesehatan bagi ASN</th>
                                <th>RP POL Belanja Honorarium</th>
                                <th>RP POL Belanja Jasa Pengelolaan BMD</th>

                                <th>TOTAL/BLN/ALL JAB</th>
                                <th>TOTAL/THN/ALL JAB</th>
                            </tr>
                        </thead>
                        @php 
                            $i=0; 
                            //Total All Data
                            $tot_all_pemangku = 0;
                            $tot_all_beban_kerja = 0;
                            $tot_all_prestasi_kerja = 0;
                            $tot_all_tunjangan = 0;
                            $persen_bk = 0;
                            $persen_pk = 0;
                        @endphp
                        <tbody id="dynamic-row">
                            @foreach($datas as $data)
                                @php 
                                    $i++; 
                                    $persen_bk = 0;
                                    $rp_beban_kerja = 0;
                                    $rp_prestasi_kerja = 0;
                                    $rp_prestasi_kerja = 0;
                                    
                                    //Beban Kerja
                                    $bk = \App\Models\Rupiah::bk();
                                    $rp_bulan_beban_kerja = ((float)$data->nilai_jabatan ?? 0) * ((float)$data->indeks ?? 0 ) * $bk;
                                    $rp_beban_kerja = $rp_bulan_beban_kerja * 13 * ($data->jumlah_pemangku ?? 0);
                                    if($data->basic_tpp > 0){
                                        $persen_bk = ($rp_bulan_beban_kerja / $data->basic_tpp) * 100;
                                    }

                                    //Prestasi Kerja
                                    $pk = \App\Models\Rupiah::pk();
                                    $rp_bulan_prestasi_kerja = ((float)$data->nilai_jabatan ?? 0) * ((float)$data->indeks ?? 0 ) * $pk;
                                    $rp_prestasi_kerja = $rp_bulan_prestasi_kerja * 12 * ($data->jumlah_pemangku ?? 0);
                                    if($data->basic_tpp > 0){
                                        $persen_pk = ($rp_bulan_prestasi_kerja / $data->basic_tpp) * 100;
                                    }

                                    //Total Tunjangan
                                    $total_per_bulan = 0;
                                    $total_per_tahun = 0;
                                    $total_per_bulan = $rp_bulan_beban_kerja + $rp_bulan_prestasi_kerja;
                                    $total_per_tahun = $rp_beban_kerja + $rp_prestasi_kerja;

                                    $tot_all_pemangku = $tot_all_pemangku + $data->jumlah_pemangku ?? 0;
                                    $tot_all_beban_kerja = $tot_all_beban_kerja + $rp_beban_kerja;
                                    $tot_all_prestasi_kerja = $tot_all_prestasi_kerja + $rp_prestasi_kerja;
                                    $tot_all_tunjangan = $tot_all_tunjangan + $total_per_tahun;
                                @endphp
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $data->nama_jabatan }}</td>
                                    <td>{{ $data->nama_opd }}</td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ $data->jenis_jabatan }}</td>
                                    <td>{{ $data->kelas_jabatan }}</td>
                                    <td>{{ $data->jumlah_pemangku }}</td>
                                    <td align="right">{{ number_format($data->basic_tpp, 2, ',', '.') }}</td>

                                    <!-- Beban Kerja -->
                                    <td></td>
                                    <td align="center">{{ number_format($persen_bk, 2, ',', '.') }} %</td>
                                    <td align="right">{{ number_format($rp_beban_kerja, 0, ',', '.') }}</td>
                                    <td align="right">{{ number_format($rp_bulan_beban_kerja, 0, ',', '.') }}</td>

                                    <!-- Prestasi Kerja -->
                                    <td></td>
                                    <td align="center">{{ number_format($persen_pk, 2, ',', '.') }} %</td>
                                    <td align="right">{{ number_format($rp_prestasi_kerja, 0, ',', '.') }}</td>
                                    <td align="right">{{ number_format($rp_bulan_prestasi_kerja, 0, ',', '.') }}</td>

                                    <!-- Kondisi Kerja -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <!-- Tempat Bertugas -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <!-- Kelangkaan Profesi -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td align="right">{{ number_format($total_per_bulan, 0, ',', '.') }}</td>
                                    <td align="right">{{ number_format($total_per_tahun, 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>{{ number_format($tot_all_pemangku, 0, ',', '.') }}</td>
                                    <td align="right"></td>

                                    <!-- Beban Kerja -->
                                    <td></td>
                                    <td align="center"></td>
                                    <td align="right">{{ number_format($tot_all_beban_kerja, 2, ',', '.') }}</td>
                                    <td align="right"></td>

                                    <!-- Prestasi Kerja -->
                                    <td></td>
                                    <td align="center"></td>
                                    <td align="right">{{ number_format($tot_all_prestasi_kerja, 2, ',', '.') }}</td>
                                    <td align="right"></td>

                                    <!-- Kondisi Kerja -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <!-- Tempat Bertugas -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <!-- Kelangkaan Profesi -->
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    <td align="right"></td>
                                    <td align="right">{{ number_format($tot_all_tunjangan, 2, ',', '.') }}</td>
                                </tr>
                        </tbody>
                    </table>
