<?php

namespace App\Http\Middleware;

use App\Models\Language;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        $allowed_languages =Language::active()->pluck('code')->toArray();
        $localization = $request->header('LANGUAGE');
        $localization = in_array($localization, $allowed_languages) ? $localization : 'ar';
        app()->setLocale($localization);
        return $next($request);
    }
}
