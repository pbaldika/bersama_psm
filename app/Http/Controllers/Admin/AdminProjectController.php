<?php

namespace App\Http\Controllers\Admin;

use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;


class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::paginate(30);
        return view('frontend.admin.project.project', ['projects' => $projects]);
    }
    public function search(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('project-search');

        // Perform the search query on the projects table
        $projects = Project::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('description', 'like', '%' . $searchQuery . '%')
            ->orWhere('progress_status', 'like', '%' . $searchQuery . '%')
            ->paginate(30);

        if ($projects->isEmpty()) {
            return view('frontend.admin.project.project', ['projects' => $projects])->with('message', "User Tidak Ditemukan.");
        }
        return view('frontend.admin.project.project')->with(['projects' => $projects]);
    }
    public function showCreate()
    {
        return view('frontend.admin.project.project-create');
    }
    public function create(Request $request)
    {
        // $request->validate([
        //     'project_photo' => 'required|image|mimes:png,jpg,jpeg|max:4096',
        //     'name' => 'required',
        //     'description' => 'required',
        //     'required_capital' => 'required',
        //     'current_capital' => 'required',
        //     'progress_status' => 'required',
        // ]);

        $filename = null;

        if ($request->file('project_photo')) {
            $filename = date('YmdHi') . '_' . $request->file('project_photo')->getClientOriginalName();
            $request->file('project_photo')->move(public_path('pro'), $filename);
        }

        $project = $request->only(['name', 'description', 'required_capital', 'current_capital', 'progress_status', 'profit_margin_bersama', 'profit_margin_investor', 'status']);
        $project['project_photo'] = $filename;

        Project::create($project);

        $projects = Project::paginate(30);
        return redirect()->route('admin.project', ['projects' => $projects])->with('message', "Projek Telah Ditambahkan");

    }

    public function update(Project $project, Request $request)
    {
        // $request->validate([
        //     'project_photo' => 'nullable|image|mimes:png,jpg,jpeg|max:4096',
        //     'name' => 'required',
        //     'description' => 'required',
        //     'required_capital' => 'required',
        //     'current_capital' => 'required',
        //     'progress_status' => 'required',
        // ]);

        // if ($request->file('project_photo')) {
        //     // Delete the old photo if it exists
        //     if ($project->project_photo && Storage::disk('public')->exists('pro/' . $project->project_photo)) {
        //         Storage::disk('public')->delete('pro/' . $project->project_photo);
        //     }

        //     $filename = date('YmdHi') . '_' . $request->file('project_photo')->getClientOriginalName();
        //     $request->file('project_photo')->storeAs('pro', $filename, 'public');
        // } else {
        //     $filename = $project->project_photo;
        // }


        $project->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'required_capital' => $request['required_capital'],
            'progress_status' => $request['progress_status'],
            'profit_margin_bersama' => $request['profit_margin_bersama'],
            'profit_margin_investor' => $request['profit_margin_investor'],
            'status' => $request['status'],
            // 'project_photo' => $filename,
        ]);

        return redirect()->back()->with('message', "Informasi Projek Telah Diperbarui!");
    }

    public function details(Project $project)
    {
        $project = Project::findOrFail($project->id);
        $project_id = $project->id;

        $investments = Investment::where('project_id', $project_id)
            ->join('users', 'investments.user_id', '=', 'users.id')
            ->select('investments.*', 'users.name', 'users.email') // Select additional user columns as needed
            ->get();
        // return dd($investments);
        return view('frontend.admin.project.project-details', ['project' => $project, 'investments' => $investments]);
    }

    public function showUpdate(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('frontend.admin.project.project-update', ['project' => $project]);
    }

    public function delete(Project $project)
    {
        $project->delete();

        $projects = Project::paginate(30);
        return redirect()->route('admin.project.project', ['projects' => $projects])->with('message', "project has been deleted!");
    }

    public function calculateProfit(Investment $investment, $profit)
    {
        $project = Project::find($investment->project_id);

        $profit_all_investor = ($project->profit_margin_investor / 100) * $profit;
        $profit_investor = ($investment->total / $project->current_capital) * $profit_all_investor;

        return $profit_investor;
    }


    public function complete(Project $project, Request $request)
    {
        // Update the progress_status and profit in the project table
        $project->progress_status = 'selesai';
        $project->profit = $request->profit;
        $project->save();

        // Update the status in the investments table
        Investment::where('project_id', $project->id)->update(['status' => 'complete']);

        // Calculate and update the profit for each investment
        $investments = Investment::where('project_id', $project->id)->get();
        foreach ($investments as $investment) {
            $profit_investor = $this->calculateProfit($investment, $request->profit);
            $investment->profit = $profit_investor;
            $investment->save();
        }

        // Redirect or return a response
        return redirect()->back()->with('message', 'Project Telah Diselesaikan! Selamat Bersama.');
    }


}