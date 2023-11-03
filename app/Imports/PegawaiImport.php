<?php

namespace App\Imports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\ToModel;

class PegawaiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegawai([
            'nip' => $row[1],
            'nama' => $row[2],
            'gelar_depan' => $row[3],
            'gelar_belakang' => $row[4],
            'tempat_lahir' => $row[5],
            'tgl_lahir' => $row[6],
            'umur_tahun' => $row[7],
            'umur_bulan' => $row[8],
            'agama' => $row[9],
            'gol_darah' => $row[10],
            'status_pernikahan' => $row[11],
            'alamat' => $row[12],
            'no_telepon' => $row[13],
            'email' => $row[14],
            'nik' => $row[15],
            'no_npwp' => $row[16],
            'no_karpeg' => $row[17],
            'kpe' => $row[18],
            'no_taspen' => $row[19],
            'no_bpjs' => $row[20],
            'no_stppl' => $row[21],
            'tmt_cpns' => $row[22],
            'no_sk_cpns' => $row[23],
            'tgl_sk_cpns' => $row[24],
            'gol_cpns' => $row[25],
            'tmt_pns' => $row[26],
            'no_sk_pns' => $row[27],
            'tgl_sk_pns' => $row[28],
            'jenis_kelamin' => $row[29],
            'BUP' => $row[30],
            'tmt_pensiun' => $row[31],
            'gol_akhir' => $row[32],
            'tmt_golongan' => $row[33],
            'masa_kerja_tahun' => $row[34],
            'masa_kerja_bulan' => $row[35],
            'jenis_jabatan' => $row[36],
            'eselon' => $row[37],
            'tmt_jabatan' => $row[38],
            'nama_jabatan' => $row[39],
            'unit_kerja' => $row[40],
            'satuan_kerja' => $row[41],
            'jenjang_pendidikan' => $row[42],
            'nama_pendidikan' => $row[43],
            'no_ijazah' => $row[44],
            'tempat_pendidikan' => $row[45],
            'tahun_lulus' => $row[46],
            'diklat_pengadaan' => $row[47],
            'ked_huk' => $row[48],
            'lokasi_kerja' => $row[49],
        ]);
    }
}
