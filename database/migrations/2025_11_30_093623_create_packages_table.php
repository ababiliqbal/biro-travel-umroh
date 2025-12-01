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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('cover_image_path')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('price');
            $table->integer('quota');
            $table->integer('payment_due_days')->default(30);
            $table->date('departure_date');
            $table->string('departure_location')->nullable();
            $table->text('facilities')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
