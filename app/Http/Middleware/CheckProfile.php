<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Auth;

class CheckProfile
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
        $user = $request->user();
        $role = auth()->user()->hasRole('influencer');
        
        if(!$user->complete && $role){
            
             return redirect()->route('frontend.user.profile.completa');
             
        }
        if(!$user->complete && !$role){
            
             return redirect()->route('frontend.user.brand.edit');
        }
        return $next($request);
    }
}
