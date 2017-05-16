<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class ShipperMiddleware
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
            if(Auth::user()->role == 1){
                return $next($request);
            }
            else{
                return redirect()->intended('/');
            }
        }
    }
}
