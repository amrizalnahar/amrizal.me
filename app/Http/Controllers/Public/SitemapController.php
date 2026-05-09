<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Project;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = [];

        // Static pages
        $urls[] = [
            'loc' => route('home'),
            'lastmod' => now()->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '1.0',
        ];
        $urls[] = [
            'loc' => route('about'),
            'lastmod' => now()->toDateString(),
            'changefreq' => 'monthly',
            'priority' => '0.8',
        ];
        $urls[] = [
            'loc' => route('portfolio.index'),
            'lastmod' => now()->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ];
        $urls[] = [
            'loc' => route('blog.index'),
            'lastmod' => now()->toDateString(),
            'changefreq' => 'weekly',
            'priority' => '0.9',
        ];
        $urls[] = [
            'loc' => route('contact'),
            'lastmod' => now()->toDateString(),
            'changefreq' => 'yearly',
            'priority' => '0.5',
        ];

        // Projects
        $projects = Project::published()->ordered()->get();
        foreach ($projects as $project) {
            $urls[] = [
                'loc' => route('portfolio.show', $project->slug),
                'lastmod' => $project->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        // Blog posts
        $posts = Post::published()->latest()->get();
        foreach ($posts as $post) {
            $urls[] = [
                'loc' => route('blog.show', $post->slug),
                'lastmod' => $post->updated_at->toDateString(),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        $xml = view('sitemap', compact('urls'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
