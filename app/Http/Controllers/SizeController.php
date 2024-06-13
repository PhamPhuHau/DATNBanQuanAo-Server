<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function View()
    {
        $Size = Size::paginate(10);
        return view('SIZE/danh-sach',compact('Size'));
    }
    public function xuLyThemMoi(Request $request)
    {
        $request->validate([
            'ten'=>'required', 
        ],[
            'ten.required'=>'không được để trống',
        ]);
        $size= new Size();

        $size->ten=$request->ten;

        $size->save();
        return redirect()->route("size.danh-sach");
    }
    public function themMoi()
    {
        return View('SIZE/them');
    }
    public function Edit($id)
    {
        $size=Size::find($id);
        if(empty($size))
        {
            return redirect()->route("size.danh-sach");
        }
        return view("SIZE.cap-nhat", compact("size"));
    }
    public function xlEdit(Request $request, $id)
    {
        $request->validate([
            'ten'=>'required', 
        ],[
            'ten.required'=>'không được để trống',
        ]);
        $size=Size::find($id);
        $size->ten=$request->ten;

        $size->save();
        return redirect()->route("size.danh-sach");
    }
    public function Delete($id)
    {
        $size=Size::find($id);
        if(empty($size))
        {
            return redirect()->route("size.danh-sach");
        }
        $size->delete();
        return redirect()->route("size.danh-sach");
    }
}
