<?php

declare(strict_types=1);

namespace App\Http\Controllers\Public;

use App\Helpers\SeoHelper;
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
            ->get();

        $categories = Category::byModule('post')
            ->whereHas('posts', function ($q) {
                $q->published();
            })
            ->get();

        $seo = SeoHelper::pageSeo('blog');

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

        if (! session()->has("viewed_post_{$post->id}")) {
            $post->increment('views');
            session()->put("viewed_post_{$post->id}", true);
        }

        $seo = [
            'title' => ($post->seo_title ?? $post->localize('title')).' — Blog',
            'description' => $post->seo_description,
            'keywords' => $post->seo_keywords,
            'og_type' => 'article',
            'og_image' => SeoHelper::ogImage($post->thumbnail),
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
            ->limit(3)
            ->get();

        $previousPost = Post::published()
            ->where('published_at', '<', $post->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        $nextPost = Post::published()
            ->where('published_at', '>', $post->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        return view('pages.blog.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'previousPost' => $previousPost,
            'nextPost' => $nextPost,
            'activeNav' => 'blog',
            'seo' => $seo,
        ]);
    }
}
