<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(Request): (Response) $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the locale from the session or user settings(if user was sign in) either use the default if it's not set.
        $localeFromSaved = Session::get('locale') ?: @$request->user()->settings['locale'];
        $locale = in_array($localeFromSaved, config('app.supported_locales')) ? $localeFromSaved : config('app.locale');

        // Set the application's locale.
        if (Session::get('locale') !== $locale)
            Session::put('locale', $locale);

        App::setLocale($locale);

        return $next($request);
    }
}
