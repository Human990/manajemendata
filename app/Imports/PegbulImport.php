<?php

namespace App\Imports;

use App\Models\Pegbul;
use Maatwebsite\Excel\Concerns\ToModel;

class PegbulImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Pegbul([
            'kode_opd' => $row[1],
            'opd' => $row[2],
            'bidang' => $row[3],
            'nip' => $row[4],
            'nama' => $row[5],
            'ks' => $row[6],
            'sts_pegawai' => $row[7],
            'jabatan' => $row[8],
            'sts_jabatan' => $row[9],
            'kelas_jabatan' => $row[10],
            'pangkat' => $row[11],
            'eselon' => $row[12],
            'jv' => $row[13],
            'indeks' => $row[14],
            'tpp' => $row[15],
            'sertifikasi_guru' => $row[16],
            'pa_kpa' => $row[17],
            'pbj' => $row[18],
            'jft' => $row[19],
            'subkoor' => $row[20],
            'nama_subkoor' => $row[21],
            'sts_subkoor' => $row[22],
            'atasan_nip' => $row[23],
            'atasan_nama' => $row[24],
            'atasannya_atasan_nip' => $row[25],
            'atasannya_atasan_nama' => $row[26],
            'bulan' => $row[27],
            'tahun' => $row[28],
        ]);
    }
}
