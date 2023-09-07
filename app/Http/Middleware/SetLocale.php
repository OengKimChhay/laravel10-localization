<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        // Determine the user's preferred locale, e.g., from user settings
        // $preferredLocale = $request->user()->locale ?? 'en';

        // Get the locale from session or use default
        $preferredLocale = session('locale', 'en'); 

        // Set the application's locale
        app()->setLocale($preferredLocale);

        return $next($request);
    }
}
