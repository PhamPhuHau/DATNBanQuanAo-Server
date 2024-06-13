<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonHangController extends Controller
{
    public function View()
    {
        return view('DONHANG/danh-sach');
    }
}
