<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class VerifyAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check()) {
            return redirect('\login');
        }

        $userRole = Auth::user()->role;
        
        foreach ($roles as $role) {
            if($userRole == $role){
                return $next($request);
            }
        }
            
        return redirect('\error');
    }
}
