<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function project(){
        $projects = Project::paginate(30);
        return view('frontend.admin.project.project', ['projects' => $projects]);
    }
    public function projectShowCreate(){
        return view('frontend.admin.project.project-create');
    }
    public function projectCreate(Request $input){
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(Project::class),
        //     ],
        //     'telephone'=> ['required', 'string', 'max:30', 'unique:projects'],
        //     'gender'=> ['required', 'string', 'max:20'],
        //     'address'=> ['required', 'string', 'max:300'],
        //     'dob'=> ['required', 'date'],
        //     'password' => $this->passwordRules(),
        //     'role'=> ['required', 'string', 'max:20'],
        // ])->validate();

        $project = Project::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'required_capital'=> $input['required_capital'],
            'current_capital'=> $input['current_capital'],
            'progress_status'=> $input['progress_status'],
            'investor'=> $input['investor'],
        ]);

        $projects = Project::paginate(30);
        return redirect()->route('frontend.admin.project.project', ['projects' => $project])->with('message',"New project added");
    }

    public function projectProfile(Project $project){
        $project = Project::findOrFail($project->id);
        return view('frontend.admin.project.project-profile', ['project' => $project]);
    }

    public function projectShowUpdate(Project $project){
        $project = Project::findOrFail($project->id);
        return view('frontend.admin.project.project-update', ['project' => $project]);
    }

    public function projectUpdate(Project $project, Request $request)
    {

        //currently not working, fix later
        // Validator::make($input, [
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
                'telephone'=> $request['telephone'],
                'gender'=> $request['gender'],
                'address'=> $request['address'],
                'dob'=> $request['dob']
            ]);

            return redirect()->back()->with('message',"Information is updated succesfully!");
    }

    public function projectDelete(Project $project){
        $project->delete();

        $projects = Project::paginate(30);
        return redirect()->route('admin.project.project', ['projects' => $project])->with('message',"project has been deleted!");
    }
}