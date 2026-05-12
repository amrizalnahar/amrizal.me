<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Profile;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredProjects = Project::published()
            ->with('technologies')
            ->ordered()
            ->take(3)
            ->get();

        $latestPosts = Post::published()
            ->with(['category', 'tags'])
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('pages.home', [
            'profile' => Profile::getProfile(),
            'featuredProjects' => $featuredProjects,
            'latestPosts' => $latestPosts,
            'activeNav' => 'home',
        ]);
    }
}
