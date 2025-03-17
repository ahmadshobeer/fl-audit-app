<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('roles')->insert([
            ['id' => 1, 'role_name' => 'Superadmin','guard_name' => 'web'],
            ['id' => 2, 'role_name' => 'Audit','guard_name' => 'web'],
            ['id' => 3, 'role_name' => 'Reguler','guard_name' => 'web']
        ]);
    }
}
