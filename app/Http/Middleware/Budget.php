<?php

namespace App\Http\Middleware;

use Closure;
use Auth,View;
use App\Http\Controllers\Frontend\Crediti\CreditiController;

class Budget {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $budget = '';

        if (Auth::user()) {
            if (auth()->user()->hasRole('influencer')) {
                $crediti = new CreditiController;
                $budget = $crediti->budget();
            }
        }

        View::share('budget', $budget);
        return $next($request);
    }

}
