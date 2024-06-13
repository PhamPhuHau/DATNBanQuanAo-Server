<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Slideshow;

class SlideshowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $slideshow = new Slideshow();
        $slideshow->url = 'Hinh_Anh/Banner01.png';
        $slideshow->save();
        $slideshow = new Slideshow();
        $slideshow->url = 'Hinh_Anh/Banner02.png';
        $slideshow->save();
        $slideshow = new Slideshow();
        $slideshow->url = 'Hinh_Anh/Banner03.png';
        $slideshow->save();
    }
}
