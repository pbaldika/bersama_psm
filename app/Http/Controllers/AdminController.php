<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        return view('frontend.admin.welcome');
    }

    public function user()
    {
        $users = User::paginate(30);
        return view('frontend.admin.user.user', ['users' => $users]);
    }
    public function userShowCreate()
    {
        return view('frontend.admin.user.user-create');
    }
    public function userCreate(Request $input)
    {
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],
        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique(User::class),
        //     ],
        //     'telephone'=> ['required', 'string', 'max:30', 'unique:users'],
        //     'gender'=> ['required', 'string', 'max:20'],
        //     'address'=> ['required', 'string', 'max:300'],
        //     'dob'=> ['required', 'date'],
        //     'password' => $this->passwordRules(),
        //     'role'=> ['required', 'string', 'max:20'],
        // ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'telephone' => $input['telephone'],
            'gender' => $input['gender'],
            'address' => $input['address'],
            'dob' => $input['dob'],
            'password' => Hash::make($input['password']),
            'role' => $input['role'],
        ]);

        $users = User::paginate(30);
        return redirect()->route('admin.user', ['users' => $user])->with('message', "New user added");
    }

    public function userProfile(User $user)
    {
        $user = User::findOrFail($user->id);

        // $investment = DB::table('investments')->where('user_id','=',$user->id)->get();

        $investments = DB::table('investments')
            ->where('user_id', '=', $user->id)
            ->join('projects', 'investments.project_id', '=', 'projects.id')
            ->get(['investments.id', 'investments.total', 'investments.status', 'investments.profit', 'investments.created_at', 'projects.name', 'projects.description']);
        // return dd($investment);

        return view('frontend.admin.user.user-profile', compact('user', 'investments'));
    }

    public function userShowUpdate(User $user)
    {
        $user = User::findOrFail($user->id);
        return view('frontend.admin.user.user-update', ['user' => $user]);
    }

    public function userUpdate(User $user, Request $request)
    {

        //currently not working, fix later
        // Validator::make($input, [
        //     'name' => ['required', 'string', 'max:255'],

        //     'email' => [
        //         'required',
        //         'string',
        //         'email',
        //         'max:255',
        //         Rule::unique('users')->ignore($user->id),
        //     ],
        //     'telephone'=> ['required', 'string', 'max:30', 'unique:users'],
        //     'gender'=> ['required', 'string', 'max:20'],
        //     'address'=> ['required', 'string', 'max:300'],
        //     'dob'=> ['required','date']
        // ])->validateWithBag('updateProfileInformation');

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'telephone' => $request['telephone'],
            'gender' => $request['gender'],
            'address' => $request['address'],
            'dob' => $request['dob']
        ]);

        return redirect()->back()->with('message', "Information is updated succesfully!");
    }

    public function userDelete(User $user)
    {
        $user->delete();

        $users = User::paginate(30);
        return redirect()->route('admin.user', ['users' => $user])->with('message', "user has been deleted!");
    }

    public function userShowVerify(User $user)
    {
        return view('frontend.admin.user.user-verify', ['user' => $user]);
    }
    public function userVerify(User $user, Request $request)
    {
        User::findOrFail($user->id)->update([
            'verified' => $request['verified'],
        ]);

        return redirect()->back()->with('message', "Status Verifikasi User Diperbarui");
    }

    public function userInvestment(Investment $investment)
    {

        // $user = User::findOrFail($user->id);
        $invest = DB::table('investments')
            ->where('investments.id', '=', $investment->id)
            ->get();
        // $project = DB::table('projects')
        // ->where('projects.id', '=', $investment->project_id)
        // ->get();

        // $investment= DB::table('investments')
        // // ->where([['investments.id', '=', $investment->id], ['user_id', '=', $user->id]])
        // ->where('investments.id', '=', $investment->id)
        // ->join('projects', 'investments.project_id','=','projects.id')
        // ->get(['investments.total', 'investments.status', 'investments.profit', 
        //         'investments.created_at', 'investments.payment_proof', 
        //         'projects.name', 'projects.description']);

        return view('frontend.admin.user.user-investment', compact('user', 'invest', 'project'));
    }

    public function makeAppointment(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'dentistID' => 'required',
            'patientID' => 'required',
            'treatmentID' => 'required',
            'date' => 'required',
            'time' => 'required',
            'status' => 'required',
        ]);


        if ($validator->fails()) {
            // Handle appointment creation failure
            return redirect()->back()->with('error', 'Failed to create appointment.');
        } else {

            Appointment::create([
                'dentistId' => $request['dentistID'],
                'patientID' => $request['patientID'],
                'treatmentID' => $request['treatmentID'],
                'date' => $request['date'],
                'time' => $request['time'],
                'status' => $request['status'],
            ]);
            
            return redirect()->route('book.appointment.new')->with('success', 'Appointment created successfully.');
        }
    }

}