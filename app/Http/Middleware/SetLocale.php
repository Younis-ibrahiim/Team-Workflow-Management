<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;


class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $available = config('app.available_locales');
        $default = config('app.locale', 'en');


        $urlLocal = $request->segment(1);
        // 1: URL Parameter
        if (in_array(strtolower($urlLocal), $available, true)) {
            $locale = $urlLocal;
        }
        // 2: session
        elseif (session()->has('locale') && in_array(session('locale'), $available, true)) {
            $locale = session('locale');
        }
        // 3: Browser locale
        else {
            $browserLocale = $this->detectBrowserLocale($request, $available);
            $locale = $browserLocale ?? $default;
        }

        App::setLocale($locale);
        session(['locale' => $locale]);

        // Global URL Defaults
        // This fixes your "redirect to non-localized route" issue
        URL::defaults([
            'locale' => $locale
        ]);

        return $next($request);
    }

    protected function detectBrowserLocale(Request $request, array $available): ?string
    {
        $header = $request->header('Accept-Language', '');
        if (!$header)
            return null;

        // Split by priority
        $languages = explode(',', $header);

        foreach ($languages as $lang) {
            // Take first 2 letters only (e.g., ar-PS => ar)
            $code = strtolower(substr($lang, 0, 2));
            if (in_array($code, $available, true)) {
                return $code;
            }
        }

        return null;
    }
}
