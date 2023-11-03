<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminJabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'username' => 'adminjabatan',
            'password' => bcrypt('12345678a'),
            'role_id' => 3,
            'opd' => 'jabatan'
        ]);
    }
}
