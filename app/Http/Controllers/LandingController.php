<?php

namespace App\Http\Controllers;
use App\Models\Project;

class LandingController extends Controller
{
    public function landing()
    {
        $projects = Project::paginate(3);
        return view('frontend.welcome', ['projects' => $projects]);
    }
}