<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        $profile = Profile::getProfile();
        $featuredProjects = Project::published()->ordered()->take(3)->get();

        return view('pages.home', [
            'profile' => $profile,
            'featuredProjects' => $featuredProjects,
            'activeNav' => 'home',
        ]);
    }
}
