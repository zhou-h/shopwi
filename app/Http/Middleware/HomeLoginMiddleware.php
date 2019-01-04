<?php

namespace App\Http\Middleware;

use Closure;

class HomeLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // 检测是否具有登录的session
        if($request->session()->has('id')){
            return $next($request);
        }else{
            // 跳转到登录界面
            return redirect('/login/create');
        }
        
    }
}
