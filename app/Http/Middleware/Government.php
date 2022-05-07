<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Government
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
        }elseif(Auth::user()->user_type == 'staff'){ 
            return redirect()->route('admin.home');
        }elseif(Auth::user()->user_type == 'visitor'){ 
            return redirect()->route('frontend.home');
        }
        elseif(Auth::user()->user_type == 'governmental_entity'){
            return $next($request);
        }else{
            Auth::logout();
            return redirect()->route('frontend.home');
        }
    }
}
