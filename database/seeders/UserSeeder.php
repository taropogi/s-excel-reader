<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user1 = new User;

        $user1->name = "Richard";
        $user1->email = "richard@reader.com";
        $user1->password = Hash::make('richard_1234');
        $user1->save();

        $user2 = new User;

        $user2->name = "Klar";
        $user2->email = "klar@reader.com";
        $user2->password = Hash::make('klar_1234');
        $user2->save();

        $user3 = new User;

        $user3->name = "Rena";
        $user3->email = "rena@reader.com";
        $user3->password = Hash::make('rena_1234');
        $user3->save();

        $user4 = new User;

        $user4->name = "Mike";
        $user4->email = "mike@reader.com";
        $user4->password = Hash::make('mike_1234');
        $user4->save();

        $user5 = new User;
        $user5->name = "Gilbert";
        $user5->email = "gilbert@reader.com";
        $user5->password = Hash::make('gilbert_1234');
        $user5->save();
    }
}
