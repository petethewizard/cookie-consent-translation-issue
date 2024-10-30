<?php

namespace App\Http\Controllers\CookiesConsent;

use Whitecube\LaravelCookieConsent\CookiesManager;
use Illuminate\Http\Request;

class ResetController
{
    public function __invoke(Request $request, CookiesManager $cookies)
    {
        $response = ! $request->expectsJson()
            ? redirect()->back()
            : response()->json([
                'status' => 'ok',
                'scripts' => $cookies->getNoticeScripts(true),
                'notice' => $cookies->getNoticeMarkup(),
            ]);

        $gaCookies = ["_ga", "_gid", "_gat", "_ga_" . str_replace('G-', '', config('analytics.google'))];

        foreach ($gaCookies as $cookieName) {
            setcookie($cookieName, '', -2628000, '/', env('GOOGLE_ANALYTICS_COOKIES_DOMAIN'));
        }

        return $response->withoutCookie(
            cookie: config('cookieconsent.cookie.name'),
            domain: config('cookieconsent.cookie.domain'),
        );
    }
}
