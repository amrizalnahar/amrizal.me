<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
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

        return view('pages.home', [
            'featuredProjects' => $featuredProjects,
            'activeNav' => 'home',
        ]);
    }
}
