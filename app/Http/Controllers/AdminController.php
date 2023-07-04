<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Investment;
use App\Models\Project;
use App\Models\Investor;
use App\Models\Funding;
use App\Models\Company;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $investorCount = User::where('role', 'user')->count();
        $activeProjectCount = Project::where('progress_status', 'aktif')->count();
        $userNeedVerify = User::where('verified', 'request')->count();
        $investmentNeedVerify = Investment::where('status', 'request')->count();

        return view('frontend.admin.welcome', [
            'userCount' => $userCount,
            'investorCount' => $investorCount,
            'activeProjectCount' => $activeProjectCount,
            'userNeedVerify' => $userNeedVerify,
            'investmentNeedVerify' => $investmentNeedVerify,
        ]);

    }

    public function user(Request $request)
    {
        // Get the selected role filter value from the request
        $roleFilter = $request->input('role');

        // Query the users table with the role filter
        $users = User::when($roleFilter, function ($query, $role) {
            // Apply the role filter if it is selected
            return $query->where('role', $role);
        })->paginate(30);

        return view('frontend.admin.user.user', ['users' => $users, 'roleFilter' => $roleFilter]);
    }

    public function searchUser(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('user-search');

        // Perform the search query on the users table
        $users = User::where('name', 'like', '%' . $searchQuery . '%')
            ->orWhere('email', 'like', '%' . $searchQuery . '%')
            ->orWhere('role', 'like', '%' . $searchQuery . '%')
            ->paginate(30);

        if ($users->isEmpty()) {
            return view('frontend.admin.user.user', ['users' => $users])->with('message', "User Tidak Ditemukan.");
        }
        return view('frontend.admin.user.user')->with(['users' => $users]);
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

    // public function userProfile(User $user)
    // {
    //     $userId = $user->id;
    //     $investments = null; // Initialize the variable with a default value
        
    //     switch ($user->role) {
    //         case 'user':
    //             $user->load('investments.project');
    //             $investments = $user->investments;
    //             break;
    //         case 'company':
    //             $fundings = Funding::where('customer_id', $userId)->get();
    //             break;
    //         default:
    //             // Handle unknown role or define default behavior
    //             break;
    //     }
        
    //     return view('frontend.admin.user.user-profile', compact('user', 'investments', 'fundings'));
    // }
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
        return redirect()->route('admin.user', ['users' => $users])->with('message', "user has been deleted!");
    }
    public function userShowVerify(User $user)
    {

        $investor = Investor::where('user_id', $user->id)->firstOrFail();
        $user = User::findOrFail($user->id);
        // return dd($investor);
        try {
            $filePath = storage_path('app/private/verification/investor/identity_photo/' . $investor->identity_photo);
            $filePath1 = storage_path('app/private/verification/investor/selfie_photo/' . $investor->identity_selfie);

            // Check if the files exist
            if (file_exists($filePath)) {
                // Return a view to display the images
                $fileContents = file_get_contents($filePath);
                $fileContents1 = file_get_contents($filePath1);
                return view('frontend.admin.user.user-investor-verify', [
                    'investor' => $investor,
                    'user' => $user
                ])->with([
                            'imageData' => base64_encode($fileContents),
                            'imageData1' => base64_encode($fileContents1) // Replace `$fileContents1` with the contents of your second image file
                        ]);

            } else {
                // File not found
                return response('File not found', 404);
            }
        } catch (\Exception $e) {
            $imageData = null;
            // Handle any exceptions that may occur
            $fileContents = file_get_contents($filePath);
            return view('frontend.admin.user.user-investor-verify', ['investor' => $investor, 'user' => $user])->with('imageData', base64_encode($fileContents));
        }
    }

    public function companyShowVerify(User $user)
    {

        $company = Company::where('user_id', $user->id)->firstOrFail();
        $user = User::findOrFail($user->id);
        // return dd($company);
        try {
            $filePath = storage_path('app/private/verification/company/' . $company->registration_photo);

            // Check if the files exist
            if (file_exists($filePath)) {
                // Return a view to display the images
                $fileContents = file_get_contents($filePath);
                return view('frontend.admin.user.user-company-verify', [
                    'company' => $company,
                    'user' => $user
                ])->with(
                        'imageData',
                        base64_encode($fileContents) //Replace `$fileContents1` with the contents of your second image file
                    );
            } else {
                // File not found
                return response('File not found', 404);
            }
        } catch (\Exception $e) {
            $imageData = null;
            // Handle any exceptions that may occur
            $fileContents = file_get_contents($filePath);
            return view('frontend.admin.user.user-company-verify', ['company' => $company, 'user' => $user])->with('imageData', base64_encode($fileContents));
        }
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
        try {
            $investment = Investment::findOrFail($investment->id);
            $user = User::findOrFail($investment->user_id);
            $project = Project::findOrFail($investment->project_id);
            $filePath = storage_path('app/private/payment/' . $investment->payment_proof);

            // Check if the file exists
            if (file_exists($filePath)) {
                // Get the file contents
                $fileContents = file_get_contents($filePath);

                // Return a view to display the image
                return view('frontend.admin.user.user-investment', compact('investment', 'user', 'project'))->with('imageData', base64_encode($fileContents));
            } elseif ($investment->payment_proof == null) {
                // File not found
                $errorMessage = 'User Belum Mengupload Bukti Gambar';
                return view('frontend.admin.user.user-investment', compact('investment', 'user', 'project', 'imageData'))->with('errorMessage', $errorMessage);
            }
        } catch (\Exception $e) {
            $imageData = null;
            // Handle any exceptions that may occur
            $errorMessage = 'Bukti Pembayaran Belum Ada';
            return view('frontend.admin.user.user-investment', compact('investment', 'user', 'project', 'imageData'))->with('errorMessage', $errorMessage);
        }
    }


}