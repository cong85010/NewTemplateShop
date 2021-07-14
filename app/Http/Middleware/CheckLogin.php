<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Session::has('admin_id')){
            return $next($request);
        } else{
            return redirect()->route('login')->with('err', 'BẠN PHẢI ĐĂNG NHẬP ĐỂ SỬ DỤNG');
        }     
    }
}
