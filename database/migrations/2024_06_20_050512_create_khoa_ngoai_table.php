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
        Schema::table('san_pham', function (Blueprint $table) {
            $table->foreign('loai_id')->references('id')->on('loai');
        });
        Schema::table('san_pham', function (Blueprint $table) {
            $table->foreign('chi_tiet_loai_id')->references('id')->on('chi_tiet_loai');
        });
        Schema::table('san_pham', function (Blueprint $table) {
            $table->foreign('nha_cung_cap_id')->references('id')->on('nha_cung_cap');
        });


        Schema::table('chi_tiet_san_pham', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });

        Schema::table('chi_tiet_san_pham', function (Blueprint $table) {
            $table->foreign('mau_id')->references('id')->on('mau');
        });

        Schema::table('chi_tiet_san_pham', function (Blueprint $table) {
            $table->foreign('size_id')->references('id')->on('size');
        });
        Schema::table('chi_tiet_san_pham', function (Blueprint $table) {
            $table->foreign('kieu_do_id')->references('id')->on('kieu_do');
        });
        Schema::table('chi_tiet_san_pham', function (Blueprint $table) {
            $table->foreign('chat_lieu_id')->references('id')->on('chat_lieu');
        });




        Schema::table('chi_tiet_nhap_hang', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });

        Schema::table('chi_tiet_nhap_hang', function (Blueprint $table) {
            $table->foreign('nhap_hang_id')->references('id')->on('nhap_hang');
        });

        Schema::table('chi_tiet_nhap_hang', function (Blueprint $table) {
            $table->foreign('nha_cung_cap_id')->references('id')->on('nha_cung_cap');
        });

        Schema::table('hoa_don', function (Blueprint $table) {
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });

        Schema::table('chi_tiet_hoa_don', function (Blueprint $table) {
            $table->foreign('hoa_don_id')->references('id')->on('hoa_don');
        });

        Schema::table('chi_tiet_hoa_don', function (Blueprint $table) {
            $table->foreign('chi_tiet_san_pham_id')->references('id')->on('chi_tiet_san_pham');
        });

        Schema::table('hinh_anh', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });

        Schema::table('binh_luan_cap_mot', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });

        Schema::table('binh_luan_cap_mot', function (Blueprint $table) {
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });

        Schema::table('binh_luan_cap_hai', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });

        Schema::table('binh_luan_cap_hai', function (Blueprint $table) {
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });

        Schema::table('binh_luan_cap_hai', function (Blueprint $table) {
            $table->foreign('binh_luan_cap_mot_id')->references('id')->on('binh_luan_cap_mot');
        });



        Schema::table('danh_gia', function (Blueprint $table) {
            $table->foreign('san_pham_id')->references('id')->on('san_pham');
        });

        Schema::table('danh_gia', function (Blueprint $table) {
            $table->foreign('khach_hang_id')->references('id')->on('khach_hang');
        });
        Schema::table('chi_tiet_loai', function (Blueprint $table) {
            $table->foreign('loai_id')->references('id')->on('loai');
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khoa_ngoai');
    }
};
