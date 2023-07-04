<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Company;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $projects = Project::paginate(3);
        return view('frontend.welcome', ['projects' => $projects]);
    }
    public function investmentList()
    {
        $projects = Project::paginate(42);
        return view('frontend.user.investment-list', ['projects' => $projects]);
    }
    public function investmentDetails(Project $project)
    {

        $project = Project::findOrFail($project->id); // Retrieve the project by ID
        $companyId = $project->company_id; // Get the company ID from the project

        $company = Company::findOrFail($companyId); // Retrieve the company by ID
        $userId = $company->user_id;

        $company = User::findOrFail($userId);
        return view('frontend.user.investment-details', ['project' => $project, 'company' => $company]);
    }
    public function placeInvestmentshow(Project $project)
    {
        $project = Project::findOrFail($project->id); // Retrieve the project by ID
        $companyId = $project->company_id; // Get the company ID from the project

        $company = Company::findOrFail($companyId); // Retrieve the company by ID
        $userId = $company->user_id;

        $company = User::findOrFail($userId);
        return view('frontend.user.place-investment', ['project' => $project, 'company' => $company]);
    }
}