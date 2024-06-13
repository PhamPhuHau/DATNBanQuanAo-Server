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
        Schema::create('san_pham', function (Blueprint $table) {
            $table->id();
            $table->string('ten',100);
            $table->string('ma',20);
            $table->double('gia_nhap');
            $table->double('gia_ban');
            $table->integer('so_luong');
            $table->foreignId('loai_id');
            $table->foreignId('nha_cung_cap_id');
            $table->string('thong_tin',5000)->nullable();
            $table->double('so_sao')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('san_pham');
    }
};
