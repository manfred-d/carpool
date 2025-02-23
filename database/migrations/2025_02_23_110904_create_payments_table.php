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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->string('payment_method');
            $table->string('payment_status')->default('pending');
            $table->timestamp('paid_at')->useCurrent();
            $table->decimal('amount', 10, 2);
            $table->string('currency')->default('KES');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
