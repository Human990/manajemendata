<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'adminkota',
            'password' => bcrypt('mastrip25'),
            'role_id' => 1,
            'opd' => 'kota'
        ]);

        User::create([
            'username' => 'dindik',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Pendidikan'
        ]);
        User::create([
            'username' => 'dinkes',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Kesehatan, Pengendalian Penduduk dan Keluarga Berencana'
        ]);
        User::create([
            'username' => 'pupr',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Pekerjaan Umum dan Penataan Ruang'
        ]);
        User::create([
            'username' => 'perkim',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Perumahan Rakyat dan Kawasan Permukiman'
        ]);
        User::create([
            'username' => 'satpolpp',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Satuan Polisi Pamong Praja dan Pemadam Kebakaran'
        ]);
        User::create([
            'username' => 'bpbd',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Badan Penanggulangan Bencana Daerah'
        ]);
        User::create([
            'username' => 'dinsos',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Sosial, Pemberdayaan Perempuan dan Perlindungan Anak'
        ]);
        User::create([
            'username' => 'naker',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Tenaga Kerja, Koperasi Usaha Kecil Dan Menengah'
        ]);
        User::create([
            'username' => 'pertanian',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Ketahanan Pangan dan Pertanian'
        ]);
        User::create([
            'username' => 'dlh',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Lingkungan Hidup'
        ]);
        User::create([
            'username' => 'capil',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Kependudukan dan Pencatatan Sipil'
        ]);
        User::create([
            'username' => 'dishub',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Perhubungan'
        ]);
        User::create([
            'username' => 'kominfo',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Komunikasi dan Informatika'
        ]);
        User::create([
            'username' => 'ptsp',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Penanaman Modal dan Pelayanan Terpadu Satu Pintu'
        ]);
        User::create([
            'username' => 'buparpora',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Kebudayaan, Pariwisata, Kepemudaan dan Olah Raga'
        ]);
        User::create([
            'username' => 'perpus',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Perpustakaan dan Kearsipan'
        ]);
        User::create([
            'username' => 'perdagangan',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Dinas Perdagangan'
        ]);
        User::create([
            'username' => 'sekda',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Sekretariat Daerah'
        ]);
        User::create([
            'username' => 'dprd',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Sekretariat DPRD'
        ]);
        User::create([
            'username' => 'bapelitbangda',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Badan Perencanaan, Penelitian dan Pengembangan Daerah'
        ]);
        User::create([
            'username' => 'bkad',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Badan Keuangan dan Aset Daerah'
        ]);
        User::create([
            'username' => 'bapenda',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Badan Pendapatan Daerah'
        ]);
        User::create([
            'username' => 'bkpsdm',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Badan Kepegawaian dan Pengembangan Sumber Daya Manusia'
        ]);
        User::create([
            'username' => 'inspektorat',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Inspektorat Daerah'
        ]);
        User::create([
            'username' => 'kecmangu',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Kecamatan Manguharjo'
        ]);
        User::create([
            'username' => 'keckarto',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Kecamatan Kartoharjo'
        ]);
        User::create([
            'username' => 'kectaman',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Kecamatan Taman'
        ]);
        User::create([
            'username' => 'kesbangpol',
            'password' => bcrypt('12345678a'),
            'role_id' => 2,
            'opd' => 'Badan Kesatuan Bangsa dan Politik'
        ]);
    }
}
