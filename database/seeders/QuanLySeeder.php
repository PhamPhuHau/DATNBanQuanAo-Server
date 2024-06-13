<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\QuanLy;
use App\Models\Loai;
use App\Models\Mau;
use App\Models\Size;
use App\Models\NhaCungCap;
use Illuminate\Support\Facades\Hash;

class QuanLySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $quanly = new QuanLy();
        $quanly->ten_dang_nhap='admin123';
        $quanly->password=Hash::make('admin123');
        $quanly ->save();


    }
}
