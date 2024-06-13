<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BinhLuanCapMot;
use App\Models\BinhLuanCapHai;

class BinhLuanController extends Controller
{
    public function DanhSachBinhLuanCapMot()
    {
        $binhLuan = BinhLuanCapMot::orderBy('id', 'desc')->with('binh_luan_cap_hai')->with('san_pham')->with('khach_hang')->get();
       
        return view('BINHLUAN/danh-sach',compact('binhLuan'));
    }
    
    public function DanhSachBinhLuanCapHai($id)
    {
        $binhLuan = BinhLuanCapHai::where('binh_luan_cap_mot_id',$id)->with('san_pham')->with('khach_hang')->get();
       
        return view('BINHLUAN/danh-sach-cap-hai',compact('binhLuan'));
    }

    public function XoaCapMot($id)
    {
        $binhLuanCapMot = BinhLuanCapMot::where('id',$id)->first();
       if($binhLuanCapMot){
         
            $binhLuanCapHai = BinhLuanCapHai::where('binh_luan_cap_mot_id',$id)->get();
            if($binhLuanCapHai)
            {
                foreach($binhLuanCapHai as $bl){
                    $bl->delete();
                }
               
            }
           $binhLuanCapMot->delete();
        }
        return redirect()->route("binh-luan.danh-sach");
    
    }

    public function XoaCapHai($id)
    {
        $binhLuanCapHai = BinhLuanCapHai::find($id);

       if($binhLuanCapHai){
            $binhLuanCapHai->delete();
            return redirect()->route("binh-luan.danh-sach");
       }
        return redirect()->route("binh-luan.danh-sach");

    }
}
