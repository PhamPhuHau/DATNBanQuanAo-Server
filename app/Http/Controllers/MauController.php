<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mau;


class MauController extends Controller
{
    public function View()
    {
        $Mau = Mau::paginate(10);
        return view('MAU/danh-sach',compact('Mau'));
    }
    public function xuLyThemMoi(Request $request)
    {
        $request->validate([
            'ten'=>'required', 
        ],[
            'ten.required'=>'không được để trống',
        ]);
        $mau= new Mau();

        $mau->ten=$request->ten;

        $mau->save();
        return redirect()->route("mau.danh-sach");
    }
    public function themMoi()
    {
        return View('MAU/them');
    }
    public function Edit($id)
    {
        
        $mau=Mau::find($id);
        if(empty($mau))
        {
            return redirect()->route("mau.danh-sach");
        }
        return view("MAU.cap-nhat", compact("mau"));
    }
    public function xlEdit(Request $request, $id)
    {
        $request->validate([
            'ten'=>'required', 
        ],[
            'ten.required'=>'không được để trống',
        ]);
        
        $mau=Mau::find($id);
        $mau->ten=$request->ten;

        $mau->save();
        return redirect()->route("mau.danh-sach");
    }
    public function Delete($id)
    {
        $mau=Mau::find($id);
        if(empty($mau))
        {
            return redirect()->route("mau.danh-sach");
        }
        $mau->delete();
        return redirect()->route("mau.danh-sach");
    }
}
