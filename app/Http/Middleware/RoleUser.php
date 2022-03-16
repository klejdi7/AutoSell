<?php

namespace App\Http\Middleware;
use Spatie\Permission\Traits\HasRoles;

use Closure;
use Illuminate\Http\Request;
use Auth;

class RoleUser
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
        if (Auth::user() &&  Auth::user()->role = 1) {
            auth()->user()->assignRole('Admin');
        }
        else {
            auth()->user()->assignRole('User');
        }
        return $next($request);    
    }
}
