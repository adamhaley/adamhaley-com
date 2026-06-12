<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $email = env('SEED_ADMIN_EMAIL', 'adamhaley@gmail.com');
        $password = env('SEED_ADMIN_PASSWORD', 'password');
        $resetPassword = (bool) env('SEED_ADMIN_RESET_PASSWORD', false);

        $user = User::firstOrNew(['email' => $email]);
        $user->name = 'admin';

        if (! $user->exists || $resetPassword) {
            $user->password = Hash::make($password);
        }

        $user->save();
    }
}
