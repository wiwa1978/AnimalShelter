<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
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
            'name'              => 'Wim-user',
            'email'             => 'wim-user@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('Welcome@1234'),
            'is_shelter'        => 0,
        ])->assignRole('user');

        $user2 = User::create([
            'name'              => 'Wim-org',
            'email'             => 'wim-org@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('Welcome@1234'),
            'is_shelter'        => 1,
        ])->assignRole('user');

        $user3 = User::create([
            'name'              => 'Marlinda-user',
            'email'             => 'marlinda-user@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('Welcome@1234'),
            'is_shelter'        => 0,
        ])->assignRole('user');

        $user4 = User::create([
            'name'              => 'Marlinda-org',
            'email'             => 'marlinda-org@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('Welcome@1234'),
            'is_shelter'        => 1,
        ])->assignRole('user');

        $user5 = User::create([
            'name'              => 'Iris-user',
            'email'             => 'iris-user@test.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('Welcome@1234'),
            'is_shelter'        => 0,
        ])->assignRole('user');


        // $organization1 = Organization::create([
        //     'name'          => 'Organisatie Wim-user',
        //     'slug'          => 'organisatie-wim-user',
        //     'is_shelter'    => false,
        //     'streetname'    => 'Brusselstraat',
        //     'streetnumber'  => '89',
        //     'zipcode'       => '1740',
        //     'city'          => 'Ternat',
        //     'country'       => 'België',
        //     'phone'         => '+32 (0)2 583 00 00',
        //     'email'         => 'wim-user@test.com'
            
        // ]);
    
        // $organization2 = Organization::create([
        //     'name'              => 'Organisatie Wim-org',
        //     'slug'              => 'organisatie-wim-org',
        //     'is_shelter'        => true,
        //     'shelter_name'      => 'VZW De Helpende Hand',
        //     'shelter_website'   => 'https://www.dehelpendehand.be/',
        //     'streetname'        => 'Dendermondsesteenweg',
        //     'streetnumber'      => '445',
        //     'zipcode'           => '1000',
        //     'city'              => 'Brussel',
        //     'country'           => 'België',
        //     'phone'             => '+31 (0)67 234 93 83',
        //     'email'             => 'info@dehelpendehand.be'
        // ]);

        // $organization3 = Organization::create([
        //     'name'              => 'Organisatie Marlinda-user',
        //     'slug'              => 'organisatie-marlinda-user',
        //     'is_shelter'        => false,
        //     'streetname'        => 'Fuga',
        //     'streetnumber'      => '4',
        //     'zipcode'           => '2925 BZ',
        //     'city'              => 'Krimpen aan den IJssel',
        //     'country'           => 'Nederland',
        //     'phone'             => '+31 (0)4873373773',
        //     'email'             => 'marlinda@test.com'
        // ]);

        // $organization4 = Organization::create([
        //     'name'              => 'Organisatie Marlinda-org',
        //     'slug'              => 'organisatie-marlinda-org',
        //     'is_shelter'        => true,
        //     'shelter_name'      => 'Dierenasiel Alkmaar',
        //     'shelter_website'   => 'https://www.dierenasielalkmaar.nl/',
        //     'streetname'        => 'Alkmaarseweg',
        //     'streetnumber'      => '1',
        //     'zipcode'           => '1775 PP',
        //     'city'              => 'Alkmaar',
        //     'country'           => 'Nederland',
        //     'phone'             => '+31 (0)897 284 13 43',
        //     'email'             => 'info@dierenasielalkmaar.nl'
        // ]);

        // // Attach users to organizations
        // $organization1->users()->attach($user1->id);
        // $organization1->users()->attach($user5->id);
        // $organization2->users()->attach($user2->id);
        // $organization3->users()->attach($user3->id);
        // $organization4->users()->attach($user4->id);

    }
}
