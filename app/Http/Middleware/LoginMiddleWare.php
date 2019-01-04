<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddleWare
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
        //检测有没有登录的session信息
        if($request->session()->has('usernames')){
            //获取访问模块控制器和方法名
            $actions=explode('\\', \Route::current()->getActionName());
            //或$actions=explode('\\', \Route::currentRouteAction());
            $modelName=$actions[count($actions)-2]=='Controllers'?null:$actions[count($actions)-2];
            $func=explode('@', $actions[count($actions)-1]);
            //控制器名字
            $controllerName=$func[0];
            //方法
            $actionName=$func[1];
            // echo $controllerName.":".$actionName;
            //4.获取访问模块控制器和方法 权限列表做对比
            $nodelist=session('nodelist');
            if(empty($nodelist[$controllerName]) ||!in_array($actionName,$nodelist[$controllerName])){
                //提示
                return redirect("/admin123")->with('error','抱歉,您没有权限访问该模块,请联系超级管理员');
            }
            // 执行下个请求
            return $next($request);
        }else{
            // 跳转到登录界面
            return redirect('/adminlogin/create');
        }
        
    }
}
