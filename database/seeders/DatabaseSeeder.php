<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(GovsSeeder::class);
        $this->call(AreaSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UserPlansSeeder::class);
        $this->call(CompanyPlansSeeder::class);
        $this->call(SingleServiceSeeder::class);
    }
}
