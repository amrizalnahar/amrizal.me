<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Daftar pattern user agent yang dikenali sebagai bot/crawler.
     */
    private array $botPatterns = [
        'bot', 'crawl', 'spider', 'slurp', 'bingbot', 'googlebot',
        'yandex', 'baidu', 'duckduckbot', 'facebookexternalhit',
        'twitterbot', 'linkedinbot', 'whatsapp', 'ahrefsbot',
        'semrushbot', 'mj12bot', 'dotbot', 'rogerbot', 'screaming',
        'yahoo', 'qwantify', 'seznambot', 'petalbot', 'applebot',
        'chrome-lighthouse', 'google-inspectiontool', 'googleother',
        'gptbot', 'chatgpt-user', 'claudebot', 'anthropic',
        'perplexity', 'bytespider', 'coherceaibot', 'imagesift',
        'omgilibot', 'diffbot', 'dataprovider', 'magpie-crawler',
        'mail.ru', 'serpstatbot', 'nimbostratus',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('admin/*') || $request->is('*.xml') || $request->is('*.txt')) {
            return $next($request);
        }

        $userAgent = strtolower($request->userAgent() ?? '');

        // Lewati bot/crawler
        foreach ($this->botPatterns as $pattern) {
            if (str_contains($userAgent, $pattern)) {
                return $next($request);
            }
        }

        // Rate limit: 1 record per IP + page_url per 5 menit
        $recentVisit = Visitor::where('ip_address', $request->ip())
            ->where('page_url', $request->fullUrl())
            ->where('visited_at', '>=', now()->subMinutes(5))
            ->exists();

        if ($recentVisit) {
            return $next($request);
        }

        Visitor::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'page_url' => $request->fullUrl(),
            'referer' => $request->header('referer'),
            'session_id' => $request->session()->getId(),
            'visited_at' => now(),
        ]);

        return $next($request);
    }
}
