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
                    'email' => 'richard@reader.com',
                    'password' => Hash::make('richard_1234'),
                ],
                [
                    'name' => 'Klar',
                    'email' => 'klar@reader.com',
                    'password' => Hash::make('klar_1234'),
                ],
                [
                    'name' => 'Rena',
                    'email' => 'rena@reader.com',
                    'password' => Hash::make('rena_1234'),
                ],
                [
                    'name' => 'Mike',
                    'email' => 'mike@reader.com',
                    'password' => Hash::make('mike_1234'),
                ],
            ]
        );
    }
}
