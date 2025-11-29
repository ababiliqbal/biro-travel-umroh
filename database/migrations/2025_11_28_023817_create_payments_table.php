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
            $table->id(); // bigint, primary key

            // Foreign key ke bookings
            $table->unsignedBigInteger('booking_id');

            $table->bigInteger('amount'); // nominal pembayaran
            $table->date('payment_date'); // tanggal pembayaran
            $table->enum('payment_method', ['cash', 'transfer']); // metode pembayaran
            $table->enum('status', ['pending', 'verified', 'rejected']); // status pembayaran

            $table->string('proof_of_payment')->nullable(); // bukti pembayaran
            $table->unsignedBigInteger('verified_by')->nullable(); // admin yang verifikasi

            $table->timestamps();

            // Relasi
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreign('verified_by')->references('id')->on('users')->onDelete('set null');
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
