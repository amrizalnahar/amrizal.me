<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use App\Models\Project;

class PortfolioController extends Controller
{
    public function index()
    {
        $projects = Project::published()->ordered()->get();
        $certificates = Certificate::published()->ordered()->get();

        return view('pages.portfolio.index', [
            'projects' => $projects,
            'certificates' => $certificates,
            'activeNav' => 'portfolio',
        ]);
    }
}
