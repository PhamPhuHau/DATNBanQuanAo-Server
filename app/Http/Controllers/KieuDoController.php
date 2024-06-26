<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KieuDo;


class KieuDoController extends Controller
{
    public function View()
    {
        $kieu_do = KieuDo::paginate(10);
        return view('KIEUDO/danh-sach',compact('kieu_do'));
    }
    public function xuLyThemMoi(Request $request)
    {
        $request->validate([
            'ten'=>'required',
        ],[
            'ten.required'=>'không được để trống',
        ]);
        $kieu_do= new KieuDo();

        $kieu_do->ten=$request->ten;

        $kieu_do->save();
        return redirect()->route("kieu-do.danh-sach");
    }
    public function themMoi()
    {
        return View('KIEUDO/them');
    }
    public function Edit($id)
    {

        $kieu_do=KieuDo::find($id);
        if(empty($kieu_do))
        {
            return redirect()->route("kieu-do.danh-sach");
        }
        return view("KIEUDO.cap-nhat", compact("kieu_do"));
    }
    public function xlEdit(Request $request, $id)
    {
        $request->validate([
            'ten'=>'required',
        ],[
            'ten.required'=>'không được để trống',
        ]);

        $kieu_do=KieuDo::find($id);
        $kieu_do->ten=$request->ten;

        $kieu_do->save();
        return redirect()->route("kieu-do.danh-sach");
    }
    public function Delete($id)
    {
        $kieu_do=KieuDo::find($id);
        if(empty($kieu_do))
        {
            return redirect()->route("kieu-do.danh-sach");
        }
        $kieu_do->delete();
        return redirect()->route("kieu-do.danh-sach");
    }
}
