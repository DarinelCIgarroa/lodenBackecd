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
        Schema::create('messages', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('event_id');
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('mail');
            $table->text('message');
            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onUpdate('cascade')
            ->onDelete('cascade');
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
