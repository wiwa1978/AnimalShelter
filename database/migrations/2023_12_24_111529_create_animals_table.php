<?php

use App\Models\Organization;
use App\Models\User;
use App\Models\Voucher;
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
            $table->foreignIdFor(User::class)->cascadeOnDelete();
            //$table->foreignIdFor(Voucher::class)->nullable();
            $table->string('animal_type');
            $table->string('location');
            $table->string('age');
            $table->string('gender');
            $table->string('status');
            $table->string('size');
            $table->text('description');
            $table->string('breed');
            $table->string('reason_adoption');
            $table->boolean('sterilized');
            $table->boolean('chipped');
            $table->boolean('passport');
            $table->boolean('vaccinated');
            $table->boolean('rabies');
            $table->boolean('medicins');
            $table->boolean('special_food');
            $table->boolean('behavioural_problem');
            $table->boolean('kids_friendly');
            $table->boolean('cats_friendly');
            $table->boolean('dogs_friendly');
            $table->text('environment');
            $table->boolean('well_behaved');
            $table->boolean('playful');
            $table->boolean('everybody_friendly');
            $table->boolean('affectionate');
            $table->string('photo_featured')->nullable();
            $table->text('photos_additional')->nullable();
            $table->text('videos')->nullable();
            $table->text('youtube_links')->nullable();
            $table->string('published_state')->default('Draft');
            $table->timestamp('published_at')->nullable();
            $table->integer('publish_price')->unsigned()->default(1000);
            $table->timestamp('unpublished_at')->nullable();
            $table->string('unpublish_reason', 255)->nullable();
            $table->integer('feature_price')->unsigned()->default(1000);
            $table->boolean('featured')->default(false);
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
