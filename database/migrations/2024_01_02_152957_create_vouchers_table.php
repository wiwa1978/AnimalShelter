<?php

use App\Models\Animal;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {

        Schema::create('Vouchers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('status')->default('active');
            $table->string('code', 32)->unique();
            $table->text('discount')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->timestamp('redeemed_at')->nullable();
            $table->foreignIdFor(User::class)->cascadeOnDelete()->nullable();
            $table->foreignIdFor(Animal::class)->cascadeOnDelete()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('Vouchers');
    }
}
