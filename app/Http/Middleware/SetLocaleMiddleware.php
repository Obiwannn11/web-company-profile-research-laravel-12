<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $locale = $request->route('locale');

        $supportedLocales = ['id', 'en'];

        if (in_array($locale, $supportedLocales)) {
            // 4. Jika didukung, atur locale aplikasi.
            app()->setLocale($locale);
        } else {
            // Jika tidak didukung (cth: /es/services), hentikan proses dan tampilkan halaman 404.
            abort(404);
        }
        
        return $next($request);
    }
}
