<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach(Config::get('app.super_admins') as $admins => $admin) {
            User::create([
                'name'              => 'super_admin',
                'email'             => $admin,
                'email_verified_at' => now(),
                'password'          => Hash::make('Welcome@1234'),
                'organization_type' => 'Particulier',
                'invited'           => false,
                'invited_at'        => null
            ])->assignRole('super_admin');
        }
            

   

       
    }
}
