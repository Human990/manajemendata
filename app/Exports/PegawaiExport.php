<?php

namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PegawaiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Pegawai::all();
    }

    public function headings(): array
    {
        return [
            'No',
            'NIP',
            'Nama',
            'Gelar Depan',
            'Gelar Belakang',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Umur (tahun)',
            'Umur (bulan)',
            'Agama',
            'Golongan Darah',
            'Status Pernikahan',
            'Alamat',
            'No Telepon',
            'Email',
            'NIK',
            'No NPWP',
            'No Karpeg',
            'KPE',
            'No Taspen',
            'No BPJS',
            'No Stppl',
            'Tmt CPNS',
            'No SK CPNS',
            'Tanggal SK CPNS',
            'Gol CPNS',
            'TMT PNS',
            'No SK PNS',
            'Tanggal SK PNS',
            'Jenis Kelamin',
            'BUP',
            'Tmt Pensiun',
            'Gol Akhir',
            'Tmt Gol',
            'Masa Kerja (tahun)',
            'Masa Kerja (bulan)',
            'Jenis Jabatan',
            'Eselon',
            'Tmt Jabatan',
            'Nama Jabatan',
            'Unit Kerja',
            'Satuan Kerja',
            'Jenjang Pendidikan',
            'Nama Pendidikan',
            'No Ijazah',
            'Tempat Pendidikan',
            'Tahun Lulus',
            'Diklat Pengadaan',
            'ked',
            'lokasi kerja',
        ];
    }
}
