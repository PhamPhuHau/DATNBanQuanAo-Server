<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\SlideShow;
use Illuminate\Support\Facades\Storage;

class SlideShowController extends Controller
{
    public function view()
    {
        // Assuming you retrieve the necessary data, including $id, from your model
        $slideShow = SlideShow::all();

        return view('SLIDESHOW.danh-sach', compact('slideShow'));
    }

    public function them_Anh(Request $request)
{
    $files = $request->file('SlideShow');

    if ($files) {
        foreach ($files as $file) {
            $slideShow = new SlideShow();
            $slideShow->url = $file->store('slideShow');
            $slideShow->save();
        }
    }

    return redirect()->route('slideshow.danh-sach')->with('success', 'Thêm ảnh thành công');
}

public function xoa_Anh($id)
{
    $slideShow = SlideShow::find($id);

    if ($slideShow) {
        Storage::delete($slideShow->url);
        $slideShow->delete();

        return redirect()->back()->with('success', 'Xóa ảnh thành công');
    }

    return redirect()->back()->with('error', 'Không tìm thấy ảnh');
}

}
