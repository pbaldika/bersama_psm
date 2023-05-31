<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function update(){
        return view('frontend.user.profile');
    }

    public function profile(Request $id){
        
    }

    public function addVerification()
    {
        return view('frontend.user.upload-ID');
    }
    public function uploadVerification(Request $request)
    {
        $request->validate([
            'IDPhoto' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);
        
        if($request->file('IDPhoto') && $request->file('SelfieIDPhoto')){

            
            $file= $request->file('IDPhoto');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/userID'), $filename);

            $file1= $request->file('SelfieIDPhoto');
            $filename1= date('YmdHi').$file1->getClientOriginalName();
            $file1-> move(public_path('public/userIDSelfie'), $filename1);


            User::findOrFail(Auth::user()->id)->update([
                'IDNumber' => $request['IDNumber'],
                'IDPhoto_name' => $filename,
                'SelfieIDPhoto_name' => $filename1,
            ]);
        }
        
        return back()->with('message',"Verification is under review!");
    }
    public function viewPhoto(Request $input)
    {
        

        return back();
    }
}
