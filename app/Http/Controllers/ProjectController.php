<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function project()
    {
        $projects = Project::paginate(30);
        return view('frontend.admin.project.project', ['projects' => $projects]);
    }
    public function projectShowCreate()
    {
        return view('frontend.admin.project.project-create');
    }
    public function projectStore(Request $request)
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
    
        if($request->file('project_photo')){
            $filename = date('YmdHi') . '_' . $request->file('project_photo')->getClientOriginalName();
            $request->file('project_photo')->move(public_path('pro'), $filename);
        }
    
        $project = $request->only(['name', 'description', 'required_capital', 'current_capital', 'progress_status']);
        $project['project_photo'] = $filename;
    
        Project::create($project);
    
        $projects = Project::paginate(30);
        return redirect()->route('admin.project', ['projects' => $projects])->with('message', "New project added");
    }

    public function projectProfile(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('frontend.admin.project.project-profile', ['project' => $project]);
    }

    public function projectShowUpdate(Project $project)
    {
        $project = Project::findOrFail($project->id);
        return view('frontend.admin.project.project-update', ['project' => $project]);
    }

    public function projectUpdate(Project $project, Request $request)
    {

        //currently not working, fix later
        // Validator::make($request, [
        //     'name' => ['required', 'string', 'max:255'],

        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique('projects')->ignore($project->id),
        //     ],
        //     'telephone'=> ['required', 'string', 'max:30', 'unique:projects'],
        //     'gender'=> ['required', 'string', 'max:20'],
        //     'address'=> ['required', 'string', 'max:300'],
        //     'dob'=> ['required','date']
        // ])->validateWithBag('updateProfileInformation');

        $project->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'address' => $request['address'],
            'dob' => $request['dob']
        ]);

        return redirect()->back()->with('message', "Information is updated succesfully!");
    }

    public function projectDelete(Project $project)
    {
        $project->delete();

        $projects = Project::paginate(30);
        return redirect()->route('admin.project.project', ['projects' => $project])->with('message', "project has been deleted!");
    }
}