<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Richard',
                    'email' => 'richard@importer.com',
                    'password' => Hash::make('richard_1234'),
                ],
                [
                    'name' => 'Klar',
                    'email' => 'klar@importer.com',
                    'password' => Hash::make('klar_1234'),
                ],
                [
                    'name' => 'Rena',
                    'email' => 'rena@importer.com',
                    'password' => Hash::make('rena_1234'),
                ],
            ]
        );
    }
}
