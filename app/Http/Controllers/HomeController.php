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

    public function placeInvestmentshow(Project $project)
    {
        $project = Project::findOrFail($project->id); // Retrieve the project by ID
        // $companyId = $project->company_id; // Get the company ID from the project

        // $company = Company::findOrFail($companyId); // Retrieve the company by ID
        // $userId = $company->user_id;

        // $company = User::findOrFail($userId);
        return view('frontend.user.place-investment', ['project' => $project]);
    }
}