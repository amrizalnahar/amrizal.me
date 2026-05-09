<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\Experience;
use App\Models\Education;
use App\Models\SkillCategory;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function __invoke()
    {
        return view('pages.about', [
            'profile' => Profile::getProfile(),
            'experiences' => Experience::ordered()->get(),
            'educations' => Education::ordered()->get(),
            'skillCategories' => SkillCategory::with('skills')->ordered()->get(),
            'activeNav' => 'about',
        ]);
    }
}
