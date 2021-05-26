<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;

class Localize
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = ($request->hasHeader('X-locale')) ? $request->header('X-locale') : app()->config->get('app.locale');
        app()->setLocale($locale);
        Carbon::setlocale($locale);
        return $next($request);
   }
}
