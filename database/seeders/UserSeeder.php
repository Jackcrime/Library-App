<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder

{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'nama' => 'Diego',
                'email' => 'a@a.com',
                'password' => Hash::make('123456'), // Hash password
                'jenis' => 'admin', // Role admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Abi',
                'email' => 'b@b.com',
                'password' => Hash::make('123456'), // Hash password
                'jenis' => 'admin', // Role admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Nando',
                'email' => 'c@c.com',
                'password' => Hash::make('123456'), // Hash password
                'jenis' => 'admin', // Role admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Edu',
                'email' => 'd@d.com',
                'password' => Hash::make('123456'), // Hash password
                'jenis' => 'admin', // Role admin
                'created_at' => now(),
                'updated_at' => now(),
            ],[
                'nama' => 'Diego',
                'email' => 'a@diegojr150608@gmail.com',
                'password' => Hash::make('123456'), // Hash password
                'jenis' => 'member', // Role admin
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
