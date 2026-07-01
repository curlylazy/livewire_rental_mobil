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
        Schema::create('paket', function (Blueprint $table) {
            $table->uuid('kodepaket')->primary();
            $table->string('tipe_mobil');
            $table->string('merk');
            $table->string('mobil');
            $table->integer('harga');
            $table->boolean('isDriver')->default(false);
            $table->boolean('isFuel')->default(false);
            $table->json('fasilitas')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pakets');
    }
};
