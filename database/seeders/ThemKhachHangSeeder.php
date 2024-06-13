<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KhachHang;
use Illuminate\Support\Facades\Hash;

class ThemKhachHangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khachHang = new KhachHang();
        $khachHang->ho_ten = 'khanh hang 1';
        $khachHang->email='hachiba';
        $khachHang->password=Hash::make('hachiba123');
        $khachHang->so_dien_thoai = '093623472';
        $khachHang->dia_chi = 'abc';
        $khachHang ->save();
    }
}
