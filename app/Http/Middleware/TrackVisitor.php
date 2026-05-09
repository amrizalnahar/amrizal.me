<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->is('admin/*') && ! $request->is('*.xml') && ! $request->is('*.txt')) {
            Visitor::create([
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'page_url' => $request->fullUrl(),
                'referer' => $request->header('referer'),
                'session_id' => $request->session()->getId(),
                'visited_at' => now(),
            ]);
        }

        return $next($request);
    }
}
