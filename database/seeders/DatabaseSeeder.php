<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\UserAdminSeeder;
use Database\Seeders\MasterTahunSeeder;
use Database\Seeders\AdminJabatanSeeder;
use Database\Seeders\MasterRupiahSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(MasterRupiahSeeder::class);
        $this->call(MasterTahunSeeder::class);
        $this->call(AdminJabatanSeeder::class);
    }
}
