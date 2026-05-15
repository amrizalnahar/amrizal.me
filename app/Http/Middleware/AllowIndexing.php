<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowIndexing
{
    /**
     * Explicitly set X-Robots-Tag to allow indexing.
     * Overrides platform defaults (e.g. Laravel Cloud noindex on .laravel.cloud domains).
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('X-Robots-Tag', 'index, follow', false);

        return $response;
    }
}
