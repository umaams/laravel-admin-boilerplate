<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App;

class SetLocale
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
        if (Auth::check()) {
            $language_code = Auth::user()->language_code;
            App::setLocale($language_code);
        }
        return $next($request);
    }
}
