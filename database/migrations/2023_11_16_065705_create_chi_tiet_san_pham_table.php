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
        Schema::create('chi_tiet_san_pham', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id');
            $table->foreignId('mau_id');
            $table->foreignId('size_id');
            $table->foreignId('kieu_do_id');
            $table->foreignId('chat_lieu_id');
            $table->integer('so_luong');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_san_pham');
    }
};
