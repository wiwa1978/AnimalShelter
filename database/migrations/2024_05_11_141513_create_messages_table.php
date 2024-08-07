<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('messages', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('organization_id')->constrained();
        //     $table->foreignId('animal_id')->constrained();
        //     $table->string('name');
        //     $table->string('email');
        //     $table->string('telephone')->nullable();
        //     $table->text('question')->nullable();
        //     $table->timestamps();
        // });
        
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('conversation_id')->constrained()->onDelete('cascade');
            $table->foreignId('organization_id')->constrained()->onDelete('cascade');
            $table->string('sender_email')->nullable();
            //$table->foreignId('receiver_id')->constrained('users')->onDelete('cascade');
            $table->string('receiver_email');
            $table->foreignId('animal_id')->constrained('animals')->onDelete('cascade');
            $table->timestamp('read_at')->nullable();
            $table->text('content');
            $table->timestamps();
        });
        



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
