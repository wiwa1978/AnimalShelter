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
        $user1 = User::create([
            'name' => 'Wim-org1',
            'email' => 'wim@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
            'organization' => false,
            'organization_name' => null,
            'website' => null,
        ]);

        $user2 = User::create([
            'name' => 'Lore-org1',
            'email' => 'lore@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
            'organization' => false,
            'organization_name' => null,
            'website' => 'organization' == true ? fake()->url() :  null,
        ]);


        $user3 = User::create([
            'name' => 'Lise-org1',
            'email' => 'lise@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
            'organization' => true,
            'organization_name' => fake()->company(),
            'website' => 'organization' == true ? fake()->url() :  null,
        ]);


        $user4 = User::create([
            'name' => 'Iris-org2',
            'email' => 'iris@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
            'organization' => true,
            'organization_name' => fake()->company(),
            'website' => 'organization' == true ? fake()->url() :  null,
        ]);


        $user5 = User::create([
            'name' => 'Charlotte-org3',
            'email' => 'charlotte@user.com',
            'email_verified_at' => now(),
            'password' => Hash::make('Wauters1978'),
            'organization' => false,
            'organization_name' => null,
            'website' => null,
        ]);



        User::factory()
            ->count(20)
            ->create();
    }
}
