<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::published()->where('slug', $slug)->firstOrFail();

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->whereHas('technologies', function ($q) use ($project) {
                $q->whereIn('technology_name', $project->technologies->pluck('technology_name'));
            })
            ->take(3)
            ->get();

        return view('pages.portfolio.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'activeNav' => 'portfolio',
        ]);
    }
}
