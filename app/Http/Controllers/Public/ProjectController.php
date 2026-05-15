<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectController extends Controller
{
    public function show(string $slug)
    {
        $project = Project::published()->with(['technologies', 'members'])->where('slug', $slug)->firstOrFail();

        $relatedProjects = Project::published()
            ->where('id', '!=', $project->id)
            ->whereHas('technologies', function ($q) use ($project) {
                $q->whereIn('technology_name', $project->technologies->pluck('technology_name'));
            })
            ->take(3)
            ->get();

        $previousProject = Project::published()
            ->where(function ($q) use ($project) {
                $q->where('sort_order', '<', $project->sort_order)
                    ->orWhere(function ($q2) use ($project) {
                        $q2->where('sort_order', '=', $project->sort_order)
                            ->where('created_at', '>', $project->created_at);
                    });
            })
            ->orderBy('sort_order', 'desc')
            ->orderBy('created_at', 'asc')
            ->first();

        $nextProject = Project::published()
            ->where(function ($q) use ($project) {
                $q->where('sort_order', '>', $project->sort_order)
                    ->orWhere(function ($q2) use ($project) {
                        $q2->where('sort_order', '=', $project->sort_order)
                            ->where('created_at', '<', $project->created_at);
                    });
            })
            ->orderBy('sort_order', 'asc')
            ->orderBy('created_at', 'desc')
            ->first();

        return view('pages.portfolio.show', [
            'project' => $project,
            'relatedProjects' => $relatedProjects,
            'previousProject' => $previousProject,
            'nextProject' => $nextProject,
            'activeNav' => 'portfolio',
        ]);
    }
}
