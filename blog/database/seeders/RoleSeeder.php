<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insData = [
            [
                'role_name' => 'Admin'
            ],
            [
                'role_name' => 'User'
            ]
        ];
        DB::table('role')->insert($insData);
    }
}
