<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Staff
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
        if(Auth::user()->user_type == 'companiesAndInstitution' || ( Auth::user()->user_type == 'cader' && Auth::user()->cawader->companies_and_institution_id != null)){ 
            return redirect()->route('company.home');
        }elseif(Auth::user()->user_type == 'client'){ 
            return redirect()->route('client.home');
        }elseif(Auth::user()->user_type == 'governmental_entity'){ 
            return redirect()->route('government.home');
        }elseif(Auth::user()->user_type == 'staff'){
            return $next($request);
        }else{
            return abort(403);
        }
    }
}
