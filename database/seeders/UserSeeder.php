<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create default user with admin privileges
        $user = new \App\Models\User();
        $user->name = 'admin';
        $user->email = 'adamhaley@gmail.com';
        $user->password = \Hash::make('password');
        $user->save();
    }
}
