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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ride_id');
            $table->unsignedBigInteger('passenger_id');
            $table->integer('seats_booked');
            $table->string('status')->default('pending');
            $table->foreign('ride_id')->references('id')->on('rides')->onDelete('cascade');
            $table->foreign('passenger_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('booked_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
