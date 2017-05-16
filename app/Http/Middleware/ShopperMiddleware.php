<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ShopperMiddleware
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
        if(!Auth::check()){
            return redirect('login');
        }else{
            if(Auth::user()->role == 0){
                return $next($request);
            }
            else{
                return redirect()->intended('/');
            }
        }
    }
}
