<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackageDocumentsTable extends Migration
{
    public function up()
    {
        Schema::create('package_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('package_id');
            $table->string('file_name');
            $table->string('file_path');
            // Contoh tipe dokumen — sesuaikan daftar enum jika perlu
            $table->enum('document_type', ['brochure','itinerary','visa','photo','other'])->default('other');
            $table->timestamps();

            // Foreign key -> packages
            $table->foreign('package_id')
                  ->references('id')->on('packages')
                  ->onDelete('cascade')   // kalau package dihapus, dokumen ikut terhapus
                  ->onUpdate('cascade');

            // Index untuk pencarian cepat
            $table->index('document_type');
            $table->index('package_id');
        });
    }

    public function down()
    {
        Schema::table('package_documents', function (Blueprint $table) {
            // Hapus foreign key dulu (nama constraint otomatis, sehingga kita bisa drop by column)
            $table->dropForeign(['package_id']);
        });
        Schema::dropIfExists('package_documents');
    }
}
