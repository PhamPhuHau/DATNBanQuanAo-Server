<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SlideShow;

class SlideShowAPIController extends Controller
{
    public function SlideShow()
    {
        $slideShow = SlideShow::all();

        return response()->json([
            'success' => true,
            'data' => $slideShow,
        ]);
    }
}
