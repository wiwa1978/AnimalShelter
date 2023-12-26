<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Wim',
            'email' => 'wim@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
        ]);

        User::create([
            'name' => 'Iris',
            'email' => 'iris@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
        ]);

        User::create([
            'name' => 'Lore',
            'email' => 'lore@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
        ]);

        User::factory()
            ->count(20)
            ->create();
    }
}
