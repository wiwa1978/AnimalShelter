<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'              => 'admin',
            'email'             => 'administrator@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('Welcome@1234'),
            'organization_type' => 'Particulier',
        ])->assignRole('super_admin');
    }
}
