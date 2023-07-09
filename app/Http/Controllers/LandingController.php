<?php

namespace App\Http\Controllers;
use App\Models\Project;

class LandingController extends Controller
{
    public function landing()
    {
        $projects = Project::inRandomOrder()->paginate(3);
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

        // $company = Company::findOrFail($companyId); // Retrieve the company by ID
        // $userId = $company->user_id;

        // $company = User::findOrFail($userId);
        return view('frontend.user.investment-details', ['project' => $project]);
    }
}