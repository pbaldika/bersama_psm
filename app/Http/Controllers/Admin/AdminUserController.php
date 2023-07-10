<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Investor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AdminUserController extends Controller
{
    public function index(Request $request)
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

    public function search(Request $request)
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

    public function showCreate()
    {
        return view('frontend.admin.user.user-create');
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'telephone' => ['required', 'string', 'max:30', 'regex:/^[+0-9]+$/'],
            'gender' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:300'],
            'dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(16)->format('Y-m-d'),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'max:20'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'telephone.required' => 'Nomor telepon harus diisi.',
            'telephone.regex' => 'Kolom telepon hanya boleh berisi angka dan tanda +.',
            'gender.required' => 'Kolom jenis kelamin harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'dob.required' => 'Tanggal lahir harus diisi.',
            'dob.date' => 'Format tanggal lahir tidak valid.',
            'dob.before_or_equal' => 'Anda harus berusia minimal 16 tahun.',
            'password.required' => 'Kolom password harus diisi.',
            'password.string' => 'Format password tidak valid.',
            'password.min' => 'Password minimal terdiri dari :min karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'role.required' => 'Kolom peran harus diisi.',
            'role.string' => 'Format peran tidak valid.',
            'role.max' => 'Peran tidak boleh melebihi :max karakter.',
        ]);
        
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('message', 'User Belum Terbuat');
        }
    
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'telephone'=> $request['telephone'],
            'gender'=> $request['gender'],
            'address'=> $request['address'],
            'dob'=> $request['dob'],
            'role'=> $request['role'],
            'verified'=>$request['verified'],
            'password' => Hash::make($request['password']),
        ]);
    
        return redirect()->route('frontend.admin.user', ['page' => $user->lastPage()])->with('message', "User Baru Telah Ditambahkan");
    }
    

    public function profile(User $user)
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



    public function showUpdate(User $user)
    {
        $user = User::findOrFail($user->id);
        return view('frontend.admin.user.user-update', ['user' => $user]);
    }

    public function update(User $user, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
            ],
            'telephone' => ['required', 'string', 'max:30', 'regex:/^[+0-9]+$/'],
            'gender' => ['required', 'string', 'max:20'],
            'address' => ['required', 'string', 'max:300'],
            'dob' => [
                'required',
                'date',
                'before_or_equal:' . now()->subYears(16)->format('Y-m-d'),
            ],
            // 'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', 'max:20'],
        ], [
            'name.required' => 'Nama harus diisi.',
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'telephone.required' => 'Nomor telepon harus diisi.',
            'telephone.regex' => 'Kolom telepon hanya boleh berisi angka dan tanda +.',
            'gender.required' => 'Kolom jenis kelamin harus diisi.',
            'address.required' => 'Alamat harus diisi.',
            'dob.required' => 'Tanggal lahir harus diisi.',
            'dob.date' => 'Format tanggal lahir tidak valid.',
            'dob.before_or_equal' => 'Anda harus berusia minimal 16 tahun.',
            // 'password.required' => 'Kolom password harus diisi.',
            // 'password.string' => 'Format password tidak valid.',
            // 'password.min' => 'Password minimal terdiri dari :min karakter.',
            'role.required' => 'Kolom peran harus diisi.',
            'role.string' => 'Format peran tidak valid.',
            'role.max' => 'Peran tidak boleh melebihi :max karakter.',
        ]);
        
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput()->with('message', 'User Belum Terbuat');
        }

        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'telephone'=> $request['telephone'],
            'gender'=> $request['gender'],
            'address'=> $request['address'],
            'dob'=> $request['dob'],
            'role'=> $request['role'],
            // 'verified'=>$request['verified'],
            // 'password' => $request['password'],
        ]);

        return view('frontend.admin.user.user-profile', compact('user', 'investments'))->with('message', "Informasi User Berhasil Di Update!");
    }

    public function delete(User $user)
    {
        $user->delete();
        $users = User::paginate(30);
        return redirect()->route('admin.user', ['users' => $users])->with('message', "user has been deleted!");
    }
    public function showVerify(User $user)
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

    public function verify(User $user, Request $request)
    {
        User::findOrFail($user->id)->update([
            'verified' => $request['verified'],
        ]);

        return redirect()->back()->with('message', "Status Verifikasi User Diperbarui");
    }
}