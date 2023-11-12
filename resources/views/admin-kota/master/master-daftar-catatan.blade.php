@extends('admin-kota.template.default')
@section('title', 'Master Tahun')
@section('master-tahun', 'active')
@section('content')
    <div class="container-fluid">
        <div class="card card-headline">
            <div class="card-header">
                <h3 class="card-title">Daftar Catatan</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('adminkota-daftar-catatan') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="pencarian" class="form-control " placeholder="Masukkan data yang dicari . . ." value="{{ $pencarian ?? '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-warning" type="submit">
                                <i class="fas fa-search fa-sm"></i> Pencarian
                            </button>
                        </div>
                    </div>
                </form></br>
                <form action="{{ route('adminkota-daftar-catatan') }}" method="GET" class="form-inline">
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
                                <th>OPD</th>
                                <th>NIP</th>
                                <th>Nama Pegawai</th>
                                <th>Catatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic-row">
                            @php $i=0; @endphp
                            @foreach($catatans as $catatan)
                            @php $i++; $no = ($catatans->currentPage() - 1) * ($catatans->perPage()) + $i; @endphp
                            <tr>
                                <td width="1%">{{ $no }}</td>
                                <td width="5%">{{ $catatan->tahun }}</td>
                                <td width="20%">{{ $catatan->nama_opd }}</td>
                                <td width="8%">{{ $catatan->nip }}</td>
                                <td width="16%">{{ $catatan->nama_pegawai }}</td>
                                <td width="32%">
                                    <b>Catatan OPD : </b>{{ $catatan->catatan_opd }}</br>
                                    @if(!empty($catatan->catatan_admin)) <b>Catatan Admin : </b>{{ $catatan->catatan_admin }} @endif
                                </td>
                                <td width="5%">{{ $catatan->status }}</td>
                                <td width="14%">
                                    @if(!empty($catatan->status))
                                        
                                    @else
                                        <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modalPegawai{{ $i }}"><i class="fa fa-edit"></i> Pegawai</button>
                                        <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modalCatatan{{ $i }}"><i class="fa fa-plus"></i> Catatan</button>
                                    @endif
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
                                                        <label for="nip">NIP</label>
                                                        <input type="text" name="nip"
                                                            class="form-control @error('nip') is-invalid @enderror" id="nip"
                                                            placeholder="NIP . . ." value="{{ $catatan->nip }}">
                                                        @error('nip')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_pegawai">Nama Pegawai</label>
                                                        <input type="text" name="nama_pegawai"
                                                            class="form-control @error('nama_pegawai') is-invalid @enderror" id="nama_pegawai"
                                                            placeholder="Nama Pegawai . . ." value="{{ $catatan->nama_pegawai }}">
                                                        @error('nama_pegawai')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_pegawai">Status Pegawai</label>
                                                        <select type="text" name="sts_pegawai" class="form-control @error('sts_pegawai') is-invalid @enderror">
                                                            <option value="PNS" @if('PNS' == $catatan->sts_pegawai) selected @endif>PNS</option>
                                                            <option value="CPNS" @if('CPNS' == $catatan->sts_pegawai) selected @endif>CPNS</option>
                                                            <option value="PPPK" @if('PPPK' == $catatan->sts_pegawai) selected @endif>PPPK</option>
                                                            <option value="GURU" @if('GURU' == $catatan->sts_pegawai) selected @endif>GURU</option>
                                                            <option value="RS" @if('RS' == $catatan->sts_pegawai) selected @endif>RS</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="opd_id">OPD</label>
                                                        <select type="text" name="opd_id" class="form-control @error('opd_id') is-invalid @enderror">
                                                            @foreach(\App\Models\Opd::data() as $opd)
                                                                <option value="{{ $opd->id }}" @if($opd->id == $catatan->opd_id) selected @endif>{{ $opd->nama_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subopd_id">Sub OPD</label>
                                                        <select type="text" name="subopd_id" class="form-control @error('subopd_id') is-invalid @enderror">
                                                            <option value="" @if($catatan->subopd_id == null) selected @endif>Bukan Sub OPD</option>
                                                            @foreach(\App\Models\Subopd::data() as $subopd)
                                                                <option value="{{ $subopd->id }}" @if($subopd->id == $catatan->subopd_id) selected @endif>{{ $subopd->nama_sub_opd }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="kode_jabatanlama">Jabatan</label>
                                                        <select type="text" name="kode_jabatanlama" class="form-control @error('kode_jabatanlama') is-invalid @enderror">
                                                            @foreach(\App\Models\Jabatan::data() as $jabatan)
                                                                <option value="{{ $jabatan->id }}" @if($jabatan->id == $catatan->kode_jabatanlama) selected @endif>{{ $jabatan->nama_jabatan }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sts_jabatan">Status Jabatan</label>
                                                        <input type="text" name="sts_jabatan"
                                                            class="form-control @error('sts_jabatan') is-invalid @enderror" id="sts_jabatan"
                                                            placeholder="Status Jabatan . . ." value="{{ $catatan->sts_jabatan }}">
                                                        @error('sts_jabatan')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pangkat">Pangkat</label>
                                                        <select type="text" name="pangkat" class="form-control @error('pangkat') is-invalid @enderror">
                                                            <option value="Juru Muda - I/a" @if('Juru Muda - I/a' == $catatan->pangkat) selected @endif>Juru Muda - I/a</option>
                                                            <option value="Juru Muda Tk.I - I/b" @if('Juru Muda Tk.I - I/b' == $catatan->pangkat) selected @endif>Juru Muda Tk.I - I/b</option>
                                                            <option value="Juru Muda Tk.I - I/c" @if('Juru Muda Tk.I - I/c' == $catatan->pangkat) selected @endif>Juru Muda Tk.I - I/c</option>
                                                            <option value="Juru Tk.I - I/d" @if('Juru Tk.I - I/d' == $catatan->pangkat) selected @endif>Juru Tk.I - I/d</option>
                                                            <option value="Pengatur Muda - II/a" @if('Pengatur Muda - II/a' == $catatan->pangkat) selected @endif>Pengatur Muda - II/a</option>
                                                            <option value="Pengatur Muda Tk.I - II/b" @if('Pengatur Muda Tk.I - II/b' == $catatan->pangkat) selected @endif>Pengatur Muda Tk.I - II/b</option>
                                                            <option value="Pengatur - II/c" @if('Pengatur - II/c' == $catatan->pangkat) selected @endif>Pengatur - II/c</option>
                                                            <option value="Pengatu Tk.I - II/d" @if('Pengatu Tk.I - II/d' == $catatan->pangkat) selected @endif>Pengatu Tk.I - II/d</option>
                                                            <option value="Penata Muda - III/a" @if('Penata Muda - III/a' == $catatan->pangkat) selected @endif>Penata Muda - III/a</option>
                                                            <option value="Penata Muda Tk.I - III/b" @if('Penata Muda Tk.I - III/b' == $catatan->pangkat) selected @endif>Penata Muda Tk.I - III/b</option>
                                                            <option value="Penata - III/c" @if('Penata - III/c' == $catatan->pangkat) selected @endif>Penata - III/c</option>
                                                            <option value="Penata Tk.I - III/d" @if('Penata Tk.I - III/d' == $catatan->pangkat) selected @endif>Penata Tk.I - III/d</option>
                                                            <option value="Pembina - IV/a" @if('Pembina - IV/a' == $catatan->pangkat) selected @endif>Pembina - IV/a</option>
                                                            <option value="Pembina Tk.I - IV/b" @if('Pembina Tk.I - IV/b' == $catatan->pangkat) selected @endif>Pembina Tk.I - IV/b</option>
                                                            <option value="Pembina Utama Muda - IV/c" @if('Pembina Utama Muda - IV/c' == $catatan->pangkat) selected @endif>Pembina Utama Muda - IV/c</option>
                                                            <option value="Pembina Utama Madya - IV/d" @if('Pembina Utama Madya - IV/d' == $catatan->pangkat) selected @endif>Pembina Utama Madya - IV/d</option>
                                                            <option value="Pembina Utama - IV/e" @if('Pembina Utama - IV/e' == $catatan->pangkat) selected @endif>Pembina Utama - IV/e</option>
                                                            <option value="Tidak Ada Pangkat--" @if('--Tidak Ada Pangkat--' == $catatan->pangkat) selected @endif>--Tidak Ada Pangkat--</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="golongan">Golongan PPPK</label>
                                                        <select type="text" name="golongan" class="form-control @error('golongan') is-invalid @enderror">
                                                            <option value="0" @if('0' == $catatan->golongan) selected @endif>0</option>
                                                            <option value="I" @if('I' == $catatan->golongan) selected @endif>I</option>
                                                            <option value="II" @if('II' == $catatan->golongan) selected @endif>II</option>
                                                            <option value="III" @if('III' == $catatan->golongan) selected @endif>III</option>
                                                            <option value="IV" @if('IV' == $catatan->golongan) selected @endif>IV</option>
                                                            <option value="V" @if('V' == $catatan->golongan) selected @endif>V</option>
                                                            <option value="VI" @if('VI' == $catatan->golongan) selected @endif>VI</option>
                                                            <option value="VII" @if('VII' == $catatan->golongan) selected @endif>VII</option>
                                                            <option value="VIII" @if('VIII' == $catatan->golongan) selected @endif>VIII</option>
                                                            <option value="IX" @if('IX' == $catatan->golongan) selected @endif>IX</option>
                                                            <option value="X" @if('X' == $catatan->golongan) selected @endif>X</option>
                                                            <option value="XI" @if('XI' == $catatan->golongan) selected @endif>XI</option>
                                                            <option value="XII" @if('XII' == $catatan->golongan) selected @endif>XII</option>
                                                            <option value="XIII" @if('XIII' == $catatan->golongan) selected @endif>XIII</option>
                                                            <option value="XIV" @if('XIV' == $catatan->golongan) selected @endif>XIV</option>
                                                            <option value="XV" @if('XV' == $catatan->golongan) selected @endif>XV</option>
                                                            <option value="XVI" @if('XVI' == $catatan->golongan) selected @endif>XVI</option>
                                                            <option value="XVII" @if('XVII' == $catatan->golongan) selected @endif>XVII</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="eselon">Eselon</label>
                                                        <input type="text" name="eselon"
                                                            class="form-control @error('eselon') is-invalid @enderror" id="eselon"
                                                            placeholder="Eselon . . ." value="{{ $catatan->eselon }}">
                                                        @error('eselon')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tpp">Status Penerima TPP</label>
                                                        <select type="text" name="tpp" class="form-control @error('tpp') is-invalid @enderror">
                                                            <option value="Penerima TPP" @if('Penerima TPP' == $catatan->tpp) selected @endif>Penerima TPP</option>
                                                            <option value="Bukan Penerima TPP" @if('Bukan Penerima TPP' == $catatan->tpp) selected @endif>Bukan Penerima TPP</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="sertifikasi_guru">Sertifikasi Guru</label>
                                                        <select type="text" name="sertifikasi_guru" class="form-control @error('sertifikasi_guru') is-invalid @enderror">
                                                            <option value="" @if(null === $catatan->sertifikasi_guru) selected @endif>Belum dipilih</option>
                                                            <option value="Sudah Sertifikasi" @if('Sudah Sertifikasi' === $catatan->sertifikasi_guru) selected @endif>Sudah Sertifikasi</option>
                                                            <option value="Belum Sertifikasi" @if('Belum Sertifikasi' === $catatan->sertifikasi_guru) selected @endif>Belum Sertifikasi</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pa_kpa">PA/KPA</label>
                                                        <input type="text" name="pa_kpa"
                                                            class="form-control @error('pa_kpa') is-invalid @enderror" id="pa_kpa"
                                                            placeholder="PA / KPA . . ." value="{{ $catatan->pa_kpa }}">
                                                        @error('pa_kpa')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                    <div class="form-group">
                                                        <label for="pbj">Sertifikasi PBJ</label>
                                                        <select type="text" name="pbj" class="form-control @error('pbj') is-invalid @enderror">
                                                            <option value="" @if(null === $catatan->pbj) selected @endif>--Tidak dipilih--</option>
                                                            <option value="Sudah Memiliki Sertifikat" @if('Sudah Memiliki Sertifikat' === $catatan->pbj) selected @endif>Sudah Memiliki Sertifikat</option>
                                                            <option value="Belum Memiliki Sertifikat" @if('Belum Memiliki Sertifikat' === $catatan->pbj) selected @endif>Belum Memiliki Sertifikat</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="subkoor">Subkoor / Koord</label>
                                                        <select type="text" name="subkoor" class="form-control @error('subkoor') is-invalid @enderror">
                                                            <option value="">--- Pilih Subkoor / Koord ---</option>
                                                            <option value="Bukan Subkoor / Koord">Bukan Subkoor / Koord</option>
                                                            <option value="Subkoor" @if('Subkoor' == $catatan->subkoor) selected @endif>Subkoor</option>
                                                            <option value="Koor" @if('Koor' == $catatan->subkoor) selected @endif>Koor</option>
                                                        </select>
                                                        @error('subkoor')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="nama_subkoor">Nama Subkoor</label>
                                                        <input type="text" name="nama_subkoor"
                                                            class="form-control @error('nama_subkoor') is-invalid @enderror" id="nama_subkoor"
                                                            placeholder="Nama Subkoor . . ." value="{{ $catatan->nama_subkoor }}">
                                                        @error('nama_subkoor')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div> 
                                                     <div class="form-group">
                                                        <label for="nama_opd">Status Subkoor / Koord</label>
                                                        <select type="text" name="sts_subkoor" class="form-control @error('sts_subkoor') is-invalid @enderror">
                                                            <option value="">--- Pilih Status ---</option>
                                                            <option value="Subkoordinator Bukan Hasil Penyetaraan" @if('Subkoordinator Bukan Hasil Penyetaraan' == $catatan->sts_subkoor) selected @endif>Subkoordinator Bukan Hasil Penyetaraan</option>
                                                            <option value="Subkoordinator Hasil Penyetaraan" @if('Subkoordinator Hasil Penyetaraan' == $catatan->sts_subkoor) selected @endif>Subkoordinator Hasil Penyetaraan</option>
                                                            <option value="Koordinator Bukan Hasil Penyetaraan" @if('Koordinator Bukan Hasil Penyetaraan' == $catatan->sts_subkoor) selected @endif>Koordinator Bukan Hasil Penyetaraan</option>
                                                            <option value="Koordinator Hasil Penyetaraan" @if('Koordinator Hasil Penyetaraan' == $catatan->sts_subkoor) selected @endif>Koordinator Hasil Penyetaraan</option>
                                                        </select>
                                                        @error('nama_opd')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pensiun">Pensiun</label>
                                                        <select type="text" name="pensiun" class="form-control @error('pensiun') is-invalid @enderror">
                                                            <option value="58" @if('58' === $catatan->pensiun) selected @endif>58</option>
                                                            <option value="60" @if('60' === $catatan->pensiun) selected @endif>60</option>
                                                            <option value="65" @if('65' === $catatan->pensiun) selected @endif>65</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="bulan_bk">Jumlah Bulan Penerimaan BK</label>
                                                        <input type="text" name="bulan_bk"
                                                            class="form-control @error('bulan_bk') is-invalid @enderror" id="bulan_bk"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="{{ $catatan->bulan_bk }}">
                                                        @error('bulan_bk')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div><div class="form-group">
                                                        <label for="bulan_pk">Jumlah Bulan Penerimaan PK</label>
                                                        <input type="text" name="bulan_pk"
                                                            class="form-control @error('bulan_pk') is-invalid @enderror" id="bulan_pk"
                                                            placeholder="Jumlah Bulan Penerimaan . . ." value="{{ $catatan->bulan_pk }}">
                                                        @error('bulan_pk')
                                                            <span class="invalid-feedback">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tpp_tambahan">Tpp Tambahan</label>
                                                        <input type="text" name="tpp_tambahan"
                                                            class="form-control @error('tpp_tambahan') is-invalid @enderror" id="tpp_tambahan"
                                                            placeholder="Tpp Tambahan . . ." value="{{ $catatan->tpp_tambahan }}">
                                                        @error('tpp_tambahan')
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
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <span style="float:right">
                    {{ $catatans->appends([ 'pencarian' => $pencarian , 'pagination' => $pagination])->links() }}</span>
                </div>
            </div>

            <div class="modal fade" id="createModalIndeks" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Master indeks</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('adminkota-indeks.store') }}" method="post" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <input type="hidden" name="tahun_id" value="{{ session()->get('tahun_id_session') }}">
                                <div class="form-group">
                                    <label for="jenis_jabatan">Jenis Jabatan</label>
                                    <select name="jenis_jabatan" id="jenis_jabatan" class="form-control">
                                        @foreach(\App\Models\Jenis_jabatan::orderBy('id', 'ASC')->get() as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->jenis_jabatan }}</option>
                                        @endforeach
                                    </select>
                                    @error('jenis_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="kelas_jabatan">Kelas Jabatan</label>
                                    <input type="number" name="kelas_jabatan"
                                        class="form-control @error('kelas_jabatan') is-invalid @enderror" id="kelas_jabatan"
                                        placeholder="Kelas Jabatan . . ." value="{{ old('kelas_jabatan') }}">
                                    @error('kelas_jabatan')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="indeks">Indeks</label>
                                    <input type="text" name="indeks"
                                        class="form-control @error('indeks') is-invalid @enderror" id="indeks"
                                        placeholder="Indeks . . ." value="{{ old('indeks') }}">
                                    @error('indeks')
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
@endsection
