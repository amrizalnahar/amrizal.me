<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;

class BeritaController extends Controller
{
    public function index()
    {
        $posts = Post::published()
            ->with(['category', 'tags', 'author'])
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        $categories = Category::byModule('post')->get();

        $seo = \App\Helpers\SeoHelper::pageSeo('blog');

        return view('pages.blog.index', [
            'posts' => $posts,
            'categories' => $categories,
            'activeNav' => 'blog',
            'seo' => $seo,
        ]);
    }

    public function show(string $slug)
    {
        $post = Post::published()
            ->with(['category', 'tags', 'author'])
            ->where('slug', $slug)
            ->firstOrFail();

        $post->increment('views');

        $seo = [
            'title' => ($post->seo_title ?? $post->title) . ' — Blog',
            'description' => $post->seo_description,
            'keywords' => $post->seo_keywords,
            'og_type' => 'article',
            'og_image' => \App\Helpers\SeoHelper::ogImage($post->thumbnail),
            'canonical_url' => route('blog.show', $post->slug),
            'meta_author' => $post->author?->name ?? config('seo.author'),
        ];

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('category_id', $post->category_id)
                  ->orWhereHas('tags', function ($tq) use ($post) {
                      $tq->whereIn('tags.id', $post->tags->pluck('id'));
                  });
            })
            ->latest('published_at')
            ->limit(4)
            ->get();

        return view('pages.blog.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'activeNav' => 'blog',
            'seo' => $seo,
        ]);
    }
}
