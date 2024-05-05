<?php

use App\Models\Organization;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('animal_type')->nullable();
            $table->foreignIdFor(Organization::class)->index();
            $table->timestamp('date_added')->nullable();
            $table->boolean('featured')->default(false);
            $table->string('approval_state')->default('In behandeling');
            $table->string('published_state')->default('Draft');
            $table->timestamp('published_at')->nullable();
            $table->timestamp('unpublished_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('unapproved_at')->nullable();
            $table->string('unpublish_reason', 255)->nullable();
            $table->string('current_location')->nullable();
            $table->string('original_location')->nullable();
            $table->boolean('current_kids')->default(false);
            $table->boolean('current_cats')->default(false);
            $table->boolean('current_dogs')->default(false);
            $table->boolean('current_home_alone')->default(false);
            $table->boolean('current_garden')->default(false);
            $table->string('adoption_fee')->nullable();;
            $table->string('age');
            $table->string('gender');
            $table->string('status');
            $table->string('size');
            $table->string('breed');
            $table->string('reason_adoption')->nullable();
            $table->boolean('sterilized');
            $table->boolean('chipped');
            $table->boolean('passport');
            $table->boolean('vaccinated');
            $table->boolean('rabies');
            $table->boolean('medicins');
            $table->boolean('special_food');
            $table->boolean('behavioural_problem');
            $table->boolean('kids_friendly_6y');
            $table->boolean('kids_friendly_14y');
            $table->boolean('cats_friendly');
            $table->boolean('dogs_friendly');
            $table->boolean('well_behaved');
            $table->boolean('playful');
            $table->boolean('everybody_friendly');
            $table->boolean('affectionate');
            $table->boolean('needs_garden');
            $table->boolean('needs_movement');
            $table->boolean('potty_trained');
            $table->boolean('car_friendly');
            $table->boolean('home_alone');
            $table->boolean('knows_commands');
            $table->boolean('experience_required');
            $table->text('description');
            $table->text('environment');
            $table->string('photo_featured')->nullable();
            $table->text('photos_additional')->nullable();
            $table->text('videos')->nullable();
            $table->text('youtube_links')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animals');
    }
};
