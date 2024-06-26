<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatLieu;


class ChatLieuController extends Controller
{
    public function View()
    {
        $chat_lieu = ChatLieu::paginate(10);
        return view('CHATLIEU/danh-sach',compact('chat_lieu'));
    }
    public function xuLyThemMoi(Request $request)
    {
        $request->validate([
            'ten'=>'required',
        ],[
            'ten.required'=>'không được để trống',
        ]);
        $chat_lieu= new ChatLieu();

        $chat_lieu->ten=$request->ten;

        $chat_lieu->save();
        return redirect()->route("chat-lieu.danh-sach");
    }
    public function themMoi()
    {
        return View('CHATLIEU/them');
    }
    public function Edit($id)
    {

        $chat_lieu=ChatLieu::find($id);
        if(empty($chat_lieu))
        {
            return redirect()->route("chat-lieu.danh-sach");
        }
        return view("CHATLIEU.cap-nhat", compact("chat_lieu"));
    }
    public function xlEdit(Request $request, $id)
    {
        $request->validate([
            'ten'=>'required',
        ],[
            'ten.required'=>'không được để trống',
        ]);

        $chat_lieu=ChatLieu::find($id);
        $chat_lieu->ten=$request->ten;

        $chat_lieu->save();
        return redirect()->route("chat-lieu.danh-sach");
    }
    public function Delete($id)
    {
        $chat_lieu=ChatLieu::find($id);
        if(empty($chat_lieu))
        {
            return redirect()->route("chat-lieu.danh-sach");
        }
        $chat_lieu->delete();
        return redirect()->route("chat-lieu.danh-sach");
    }
}
