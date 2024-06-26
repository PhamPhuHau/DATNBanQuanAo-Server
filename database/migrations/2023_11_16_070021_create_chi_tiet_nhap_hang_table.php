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
        Schema::create('chi_tiet_nhap_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nhap_hang_id');
            $table->foreignId('san_pham_id');
            $table->foreignId('nha_cung_cap_id');
            $table->double('gia_nhap');
            $table->double('gia_ban');
            $table->integer('so_luong');
            $table->double('thanh_tien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_nhap_hang');
    }
};
