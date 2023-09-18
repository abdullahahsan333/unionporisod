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
        DB::table('users')->insert([
            'name' => 'Freelance iT Lab',
            'email' => 'freelnaceitlab.@gmail.com',
            'privilege' => 'admin',
            'username' => 'admin2021',
            'password' => Hash::make('admin2021'),
        ]);
    }
}
