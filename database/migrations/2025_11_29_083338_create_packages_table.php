<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('cover_image_path')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedInteger('quota')->default(0);
            $table->date('departure_date')->nullable();
            $table->text('facilities')->nullable(); // bisa simpan JSON/CSV
            $table->timestamps();

            // Index contoh (opsional)
            $table->index('departure_date');
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
