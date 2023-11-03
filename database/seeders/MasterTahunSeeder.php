<?php

namespace Database\Seeders;

use App\Models\Tahun;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterTahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tahun::create([
            'tahun' => '2023',
        ]);
        Tahun::create([
            'tahun' => '2024',
        ]);
        Tahun::create([
            'tahun' => '2025',
        ]);
        Tahun::create([
            'tahun' => '2026',
        ]);
        Tahun::create([
            'tahun' => '2027',
        ]);
        Tahun::create([
            'tahun' => '2028',
        ]);
        Tahun::create([
            'tahun' => '2029',
        ]);
        Tahun::create([
            'tahun' => '2030',
        ]);
    }
}
