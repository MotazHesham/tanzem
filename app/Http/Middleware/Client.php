<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Client
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
        if(Auth::user()->user_type == 'companiesAndInstitution'){ 
            return redirect()->route('company.home');
        }elseif(Auth::user()->user_type == 'staff'){ 
            return redirect()->route('admin.home');
        }elseif(Auth::user()->user_type == 'governmental_entity'){ 
            return redirect()->route('government.home');
        }
        return $next($request);
    }
}
