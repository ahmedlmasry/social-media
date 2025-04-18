<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $locale = $request->header('Accept-Language', 'en');
        app()->setLocale(in_array($locale, ['en', 'ar']) ? $locale : 'en');

        return $next($request);
    }
}
