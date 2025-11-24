<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Skip language switching for admin routes
        if ($request->is('admin*') || $request->is('login') || $request->is('logout')) {
            // Force English for admin panel and authentication
            App::setLocale('en');
            return $next($request);
        }

        // Get locale from session or default to 'en' for public routes
        $locale = Session::get('locale', 'en');

        // Validate locale
        if (!in_array($locale, ['en', 'ar'])) {
            $locale = 'en';
        }

        // Set application locale
        App::setLocale($locale);

        return $next($request);
    }
}
