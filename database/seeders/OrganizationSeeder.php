<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Organization::create([
            'id' => 1, // 'id' => '0',
            'name' => 'Individual',
            'slug' => 'individual',
        ]);

        Organization::create([
            'id' => 2, // 'id' => '1',
            'name' => 'Organisation A',
            'slug' => 'organisation-A',
        ]);

        Organization::create([
            'id' => 3, // 'id' => '1',
            'name' => 'Organisation B',
            'slug' => 'organisation-B',
        ]);

        Organization::create([
            'id' => 4, // 'id' => '1',
            'name' => 'Organisation C',
            'slug' => 'organisation-C',
        ]);
    }
}
