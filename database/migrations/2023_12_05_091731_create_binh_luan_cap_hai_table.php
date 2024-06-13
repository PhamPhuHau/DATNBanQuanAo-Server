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
        Schema::create('binh_luan_cap_hai', function (Blueprint $table) {
            $table->id();
            $table->foreignId('binh_luan_cap_mot_id');
            $table->foreignId('san_pham_id');
            $table->foreignId('khach_hang_id');
            $table->string('noi_dung');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('binh_luan_cap_hai');
    }
};
