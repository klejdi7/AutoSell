<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session; 

class CartSession
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
        if(!(session()->get('cart'))){
        Session::put('cart');
        }
        return $next($request);
    }
}
