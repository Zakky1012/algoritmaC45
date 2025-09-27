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
        Schema::create('data_uji', function (Blueprint $table) {
            $table->id();
            $table->string('nib')->unique();
            $table->string('nama_perusahaan');
            $table->string('skala_usaha');
            $table->string('nama_proyek')->nullable();
            $table->text('alamat_usaha')->nullable();
            $table->string('kecamatan_usaha')->nullable();
            $table->string('kelurahan_usaha')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('nomor_identitas_user')->nullable();
            $table->string('email')->nullable();
            $table->string('nomor_telp')->nullable();
            $table->bigInteger('modal_usaha')->nullable();
            $table->integer('tenaga_kerja')->nullable();
            $table->enum('label', ['layak', 'Tidak layak', 'pertimbangkan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_uji');
    }
};
