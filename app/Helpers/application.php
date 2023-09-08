<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

function changeLocale (string $locale): void
{
    if (! in_array($locale, config('app.supported_locales'))) {
        abort(400);
    }

    if (Session::get('locale') != $locale)
        Session::put('locale', $locale);

    App::setLocale($locale);
}
