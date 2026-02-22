<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use App\Models\Country;
class EnsureSettingDefaultCountryMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if country is already in session
        if (!Session::has('user_country')) {
            $country = Country::where('active' , 1 )->first();        
            // Store in session
            Session::put('user_country', $country->id);
        }
        return $next($request);
    }
}
