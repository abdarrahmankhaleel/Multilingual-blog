<?php

namespace App\Http\Middleware;
//عشان تسخدم او تفعل او تعرف الميدل وير لازم تكتبها في الكيرنل وتديلها نيم وهو الكي عشان تبقى تستخدمه في الراوت
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
    $userStatus=['admin','writer'];
    if(!in_array(auth()->user()->status,$userStatus)){
        auth()->logout();
        return redirect()->route('login');
    }
        // if(auth()->user()->status!='admin' and auth()->user()->status!='writer'){
        //     auth()->logout();
        //     return redirect()->route('login');
        // }
        return $next($request);
    }
}
