<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\KhachHang;
use Illuminate\Support\Facades\Hash;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
class KhachHangAPIController extends Controller
{
    public function login(Request $request)
    {
        $validation = validator::make(request(['email','password']),[
            'email'=>'required',
            'password' => 'required',
        ],[
            'email.required'=>'không được để trống',
            'password.required'=>'không được để trống',

        ]);

        if($validation->fails())
        {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $credentials = request(['email', 'password']);
        
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ]);
    }
    public function doiMatKhau(Request $request)
    {
        $validation = Validator::make(request()->all(), [ 
        'password' => 'required|min:6',
    ], [
        'password.required' => 'Không thể để trống',
        'password.min' => 'Tối thiểu 6 ký tự',
    ]);
    
    if ($validation->fails()) {
        return response()->json(['errors' => $validation->errors()], 422);
    }
    
        $credentials = request(['email', 'password']);
        if (! $token = auth('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $khachHang = KhachHang::where('email',$request->email)->first();
        $khachHang->password=hash::make($request->newPassWord);
        $khachHang->save();
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
        ]);
    }
    public function capNhatThongTin(Request $request)
    {
        $validation = Validator::make(request()->all(), [
            'ho_ten' => 'required',
            'so_dien_thoai' => 'required|numeric',
            'dia_chi' => 'required',
        ], [
            'ho_ten.required' => 'không được để trống',
            'so_dien_thoai.required' => 'không được để trống',
            'so_dien_thoai.numeric' => 'phải là số',
            
            'dia_chi.required' => 'không được để trống',
        ]);
        
        if($validation->fails())
        {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $khachHang = KhachHang::where('email',$request->email)->first();
        $khachHang->ho_ten=$request->ho_ten;
        $khachHang->so_dien_thoai=$request->so_dien_thoai;
        $khachHang->dia_chi=$request->dia_chi;

        $khachHang->save();
        return response()->json([
            "success"=>true,
            "message"=>"thành công",
        ]);
    }
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function Regester(request $rq)
    {
        $validation = Validator::make(request()->all(), [
            'email' => 'required',
            'password' => 'required|min:6',
            'hoTen' => 'required',
            'soDienThoai' => 'required|numeric',
            'diaChi' => 'required',
        ], [
            'email.required' => 'không được để trống',
            'password.required' => 'không được để trống',
            'password.min' => 'mật khẩu ít nhất 6 ký tự',
            'hoTen.required' => 'không được để trống',
            'soDienThoai.required' => 'không được để trống',
            'soDienThoai.numeric' => 'phải là số',
            
            'diaChi.required' => 'không được để trống',
        ]);
        
        if($validation->fails())
        {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $khachHang = KhachHang::where('email',$rq->email)->first();
       
        if($khachHang)
        {
            return response()->json(['errors' => 'tài khoản đã tồn tại'], 422);
        }
       
        $khachHang = new KhachHang();
        $khachHang->ho_ten = $rq->hoTen;
        $khachHang->email = $rq->email;
        $khachHang->password = Hash::make($rq->password);
        $khachHang->so_dien_thoai = $rq->soDienThoai;
        $khachHang->dia_chi = $rq->diaChi;
        $khachHang->save();
        return response()->json([
            'message' => 'thanh cong'
        ]);
    }

    public function LayLaiMatKhau(Request $request)
    {

        $validation = validator::make(request(['email']),[
            'email'=>'required',
           
        ],[
            'email.required'=>'Email không được để trống',
        ]);

        if($validation->fails())
        {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        $khachHang = KhachHang::where('email', $request->email)->first();

        if (!$khachHang) {
            return response()->json([
                'message' => 'Không tìm thấy người dùng với địa chỉ email này.'
            ], 404);
        }
        
        $matKhauMoi = Str::random(6);
        $khachHang->password = Hash::make($matKhauMoi);
        $khachHang->save();
        Mail::send('EMAIL.gui-mail', compact('khachHang','matKhauMoi'), function ($email) use ($khachHang) {
            $email->to($khachHang->email, $khachHang->ho_ten);
        });
    
        return response()->json([
            'message' => 'Thành công'
        ]);
    }


public function ThemAvatar(Request $request)
{
        // Kiểm tra xem request có chứa file hình ảnh hay không
        $validation = Validator::make(request()->all(), [
            'image' => 'required',
            'khachHangID' => 'required|numeric',
            
        ], [
            'image.required' => 'hãy chọn ảnh',
            'khachHangID.required' => 'vui lóng đăng nhập',
           
        ]);
        
        if($validation->fails())
        {
            return response()->json(['errors' => $validation->errors()], 422);
        }

        // Lưu hình ảnh vào thư mục public/avatar
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('avatar'), $imageName);

        // Cập nhật trường "avatar" trong bảng KhachHang
        $khachHang = KhachHang::find($request->khachHangID);

        // Kiểm tra xem có khách hàng tương ứng không
        if(!$khachHang) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        // Cập nhật avatar
        $khachHang->avatar = $imageName;
        $khachHang->save();

        // Trả về phản hồi thành công
        return response()->json(['success' => true, 'image_name' => $imageName]);
    }

    
}
