<?php

namespace Database\Factories;

use App\Enums\AnimalAge;
use App\Enums\AnimalPublishState;
use App\Models\User;
use App\Enums\AnimalSize;
use App\Enums\AnimalType;
use App\Enums\AnimalGender;
use App\Enums\AnimalStatus;
use App\Enums\ApprovalState;
use App\Models\Organization;
use App\Enums\AnimalLocation;
use App\Enums\AnimalAdoptionFee;
use App\Enums\AnimalApprovalState;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $published_state = fake()->randomElement(AnimalPublishState::cases());
        $approval_state = AnimalApprovalState::NOTAPPLICABLE;

        $faker = \Faker\Factory::create();
        $faker->addProvider(new \Smknstd\FakerPicsumImages\FakerPicsumImagesProvider($faker));

        // return a string that contains a url like 'https://picsum.photos/800/600/'

        $type = fake()->randomElement(AnimalType::options());
        
        return [
            'name'                  =>      $type . '-' . fake()->numberBetween(1, 50),
            'slug'                  =>      fake()->slug(3),
            'animal_type'           =>      $type == 'Hond' ? 'Dog' :  ($type == 'Kat' ? 'Cat' : 'Other'),
            //'animal_type'           =>      $type == 'Dog' ? 'Dog' :  ($type == 'Cat' ? 'Cat' : 'Other'),
            'organization_id'       =>      Organization::query()->inRandomOrder()->first()?->id ?? Organization::factory(),
            'date_added'            =>      fake()->dateTimeBetween('-3 Months', '-1 Week'),
            'featured'              =>      fake()->boolean(),
            'published_at'          =>      $published_state == 'Gepubliceerd' ? fake()->dateTimeBetween('-1 Week', '-1 Day') :  null,
            'unpublished_at'        =>      $published_state == 'Niet gepubliceerd' ? fake()->dateTimeBetween('-1 Week', '-1 Day') :  null,
            'approval_state'        =>      $approval_state//fake()->randomElement(AnimalApprovalState::cases()),
            'published_state'       =>      $published_state,
            'unpublish_reason'      =>      $published_state == 'Niet gepubliceerd' ?  fake()->words(3, asText: true) :  null,
            'current_location'      =>      fake()->randomElement(AnimalLocation::cases()),
            'original_location'     =>      fake()->randomElement(AnimalLocation::cases()),
            'current_kids'          =>      fake()->boolean(),
            'current_cats'          =>      fake()->boolean(),
            'current_dogs'          =>      fake()->boolean(),
            'current_home_alone'    =>      fake()->boolean(),
            'current_garden'        =>      fake()->boolean(),
            'adoption_fee'          =>      fake()->randomElement(AnimalAdoptionFee::cases()),
            'age'                   =>      fake()->randomElement(AnimalAge::cases() ),
            'gender'                =>      fake()->randomElement(AnimalGender::cases()),
            'status'                =>      fake()->randomElement(AnimalStatus::cases()),
            'size'                  =>      fake()->randomElement(AnimalSize::cases()),
            'breed'                 =>      fake()->words(2, asText: true),
            'reason_adoption'       =>      fake()->words(2, asText: true),
            'sterilized'            =>      fake()->boolean(),
            'chipped'               =>      fake()->boolean(),
            'passport'              =>      fake()->boolean(),
            'vaccinated'            =>      fake()->boolean(),
            'rabies'                =>      fake()->boolean(),
            'medicins'              =>      fake()->boolean(),
            'special_food'          =>      fake()->boolean(),
            'behavioural_problem'   =>      fake()->boolean(),
            'kids_friendly_6y'      =>      fake()->boolean(),
            'kids_friendly_14y'     =>      fake()->boolean(),
            'cats_friendly'         =>      fake()->boolean(),
            'dogs_friendly'         =>      fake()->boolean(),
            'well_behaved'          =>      fake()->boolean(),
            'playful'               =>      fake()->boolean(),
            'everybody_friendly'    =>      fake()->boolean(),
            'affectionate'          =>      fake()->randomElement([true, false]),
            'needs_garden'          =>      fake()->boolean(),
            'needs_movement'        =>      fake()->boolean(),
            'potty_trained'         =>      fake()->boolean(),
            'car_friendly'          =>      fake()->boolean(),
            'home_alone'            =>      fake()->boolean(),
            'knows_commands'        =>      fake()->boolean(),
            'experience_required'   =>      fake()->boolean(),
            'description'           =>      fake()->paragraphs(fake()->numberBetween(4, 8), true),
            'environment'           =>      fake()->paragraphs(fake()->numberBetween(4, 8), true),
            'photo_featured'        =>      $faker->imageUrl(width: 800, height: 600, randomize: false, id: fake()->numberBetween(1, 100)),
            'photos_additional'     => [
                $faker->imageUrl(width: 800, height: 600, randomize: false, id: fake()->numberBetween(1, 100)), $faker->imageUrl(width: 800, height: 600, randomize: false, id: fake()->numberBetween(1, 100)), $faker->imageUrl(width: 800, height: 600, randomize: false, id: fake()->numberBetween(1, 100))
            ],
        ];
    }
}
