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
                [
                   'name' => 'test1',
                   'email' => 'test1@gmail.com',
                   'password' => Hash::make('password1'),
                ],
                [
                   'name' => 'test2',
                   'email' => 'test2@gmail.com',
                   'password' => Hash::make('password2'),
                ]
        ]);
    }
}
