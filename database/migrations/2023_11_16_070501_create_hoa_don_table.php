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
        Schema::create('hoa_don', function (Blueprint $table) {
            $table->id();
            $table->string('ma')->nullable();;
            $table->double('tong_tien');
            $table->double('tien_ship');
            $table->foreignId('khach_hang_id');
            $table->integer('trang_thai');
            $table->string('phuong_thuc_thanh_toan');
            $table->integer('trang_thai_thanh_toan');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don');
    }
};
