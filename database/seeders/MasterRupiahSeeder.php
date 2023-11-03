<?php

namespace Database\Seeders;

use App\Models\Rupiah;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterRupiahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rupiah::create([
            'nama' => 'bk',
            'jumlah' => '3000',
        ]);

        Rupiah::create([
            'nama' => 'pk',
            'jumlah' => '7000',
        ]);

        Rupiah::create([
            'nama' => 'pagu APBD',
            'jumlah' => '1232967032000',
        ]);

        Rupiah::create([
            'nama' => 'Belanja Pegawai',
            'jumlah' => '498581582234',
        ]);
    }
}
