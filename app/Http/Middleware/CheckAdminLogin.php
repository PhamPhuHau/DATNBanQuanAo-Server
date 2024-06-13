<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        //Kiểm tra
        $adminLogin=session()->get('logged_in');

        if(empty($adminLogin))
        {
            return redirect()->route('dang-nhap');
        }
        #Thực hiện tiếp tục request
        return $next($request);

        /*
        if (empty(session('logged_in')))
        {
            return redirect()->route('DangNhap');
        }

        //thực hiện tiếp tục request
        return $next($request);
        */
    }
}
