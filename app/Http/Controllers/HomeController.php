<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('frontend.welcome');
    }
    public function landing()
    {
        $projects = Project::paginate(3);
        return view('landing', ['projects' => $projects]);    
    }
    public function indexVerified()
    {
        return view('welcome1');
    }
    public function investmentList()
    {
        $projects = Project::paginate(12);
        return view('frontend.user.investment-list', ['projects' => $projects]);
    }
    public function investmentDetails(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('frontend.user.investment-details', ['project' => $project]);
    }
    public function placeInvestmentshow(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('frontend.user.place-investment', ['project' => $project]);
    }
}
