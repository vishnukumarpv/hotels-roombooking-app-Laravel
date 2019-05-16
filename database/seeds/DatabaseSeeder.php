<?php

use Illuminate\Database\Seeder;
use App\Roles;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Roles::firstOrCreate(['name' => Roles::ROLE_ADMIN]);
        Roles::firstOrCreate(['name' => Roles::ROLE_SUP_ADMIN]);
        Roles::firstOrCreate(['name' => Roles::ROLE_HOTEL_OWNER]);
    }
}
