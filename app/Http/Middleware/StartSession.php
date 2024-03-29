<?php

namespace App\Http\Middleware;

use Closure;

class StartSession
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

        if (session()->has('locale') == null) {
            $lang = session()->put('locale','ar');
            app()->setLocale($lang);
        }
        return $next($request);
    }
}
