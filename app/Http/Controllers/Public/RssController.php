<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Response;

class RssController extends Controller
{
    public function __invoke(): Response
    {
        $posts = Post::published()->latest()->take(20)->get();

        $xml = view('rss', compact('posts'))->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml',
        ]);
    }
}
