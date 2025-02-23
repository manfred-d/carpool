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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('car_id');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
            $table->string('phone');
            $table->integer('available_seats');
            $table->decimal('price',8,2)->nullable();
            $table->string('start_location_id')->references('id')->on('locations');
            $table->string('end_location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->string('departure_time');
            $table->string('status')->default('available');
            $table->boolean('is_enabled')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
