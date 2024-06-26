<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChiTietLoai;

class ChiTietLoaiController extends Controller
{
    public function view($loai_id)
    {
        $chi_tiet_loai = ChiTietLoai::where('loai_id', $loai_id)->paginate(10);
        return view('CHITIETLOAI.danh-sach', compact('chi_tiet_loai', 'loai_id'));
    }

   // In your ChiTietLoaiController
   public function themMoi($loai_id)
   {
       return view('CHITIETLOAI.them', compact('loai_id'));
   }


public function xuLyThemMoi(Request $request)
{
    $request->validate([
        'ten' => 'required',
        'loai_id' => 'required|integer',
    ], [
        'ten.required' => 'Tên không được để trống',
        'loai_id.required' => 'Loại ID không được để trống',
        'loai_id.integer' => 'Loại ID phải là số nguyên',
    ]);

    $chi_tiet_loai = new ChiTietLoai();
    $chi_tiet_loai->ten = $request->ten;
    $chi_tiet_loai->loai_id = $request->loai_id;
    $chi_tiet_loai->save();

    return redirect()->route('chi-tiet-loai.danh-sach', ['loai_id' => $request->loai_id]);
}


public function Edit($id)
{
    $chi_tiet_loai = ChiTietLoai::find($id);
    return view('CHITIETLOAI.cap-nhat', compact('chi_tiet_loai'));
}

public function xlEdit(Request $request, $id)
{
    $request->validate([
        'ten' => 'required|string|max:255',
    ], [
        'ten.required' => 'Tên không được để trống',
        'ten.max' => 'Tên không được vượt quá 255 ký tự',
    ]);

    $chi_tiet_loai = ChiTietLoai::find($id);
    $chi_tiet_loai->ten = $request->ten;
    $chi_tiet_loai->save();

    return redirect()->route('chi-tiet-loai.danh-sach', ['loai_id' => $chi_tiet_loai->loai_id])->with('success', 'Cập nhật thành công!');
}



    public function Delete($id)
    {
        $chi_tiet_loai = ChiTietLoai::find($id);
        if (empty($chi_tiet_loai)) {
            return redirect()->route("chi-tiet-loai.danh-sach");
        }
        $chi_tiet_loai->delete();

        return redirect()->route("chi-tiet-loai.danh-sach");
    }
}
