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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('last_name');
            $table->string('second_last_name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('instagram_link');
            $table->string('facebook_link');
            $table->string('intro', 255);
            $table->string('occupation');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
