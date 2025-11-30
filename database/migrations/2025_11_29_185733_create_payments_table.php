<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id');
            $table->bigInteger('amount');
            $table->date('payment_date');
            $table->enum('payment_method', ['transfer', 'cash']);
            $table->enum('status', ['pending', 'verified']);
            $table->string('proof_of_payment')->nullable();
            $table->unsignedBigInteger('verified_by')->nullable();
            $table->timestamps();

            // RELASI
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('verified_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
