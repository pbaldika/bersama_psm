<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    public function update()
    {
        return view('frontend.user.profile');
    }

    public function profile(Request $id)
    {

    }

    public function addVerification()
    {
        return view('frontend.company.upload-registration');
    }

    public function storeVerification(Request $request)
    {
        // $request->validate([
        //     'identity_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_selfie' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_number' => 'required',
        //     'identity_type' => 'required',
        // ]);

        if ($request->hasFile('registration_photo')) {
            $IDPhoto = $request->file('registration_photo');

            $filename = date('YmdHi') . '_' . $IDPhoto->getClientOriginalName();

            // Store the new images
            $IDPhoto->storeAs('private/verification/company/', $filename);

            $data = [
                'user_id' => Auth::user()->id,
                'registration_type' => $request['registration_type'],
                'registration_number' => $request['registration_number'],
                'registration_photo' => $filename,
            ];

            $company = Company::where('user_id', Auth::user()->id)->first();

            if ($company) {
                // Delete old images
                $oldRegistrationPhoto = $company->registration_photo;

                if ($oldRegistrationPhoto && Storage::exists('private/verification/company/' . $oldRegistrationPhoto)) {
                    Storage::delete('private/verification/company/' . $oldRegistrationPhoto);
                }

                $company->update($data);
            } else {
                Company::create($data);
            }
            User::where('id', Auth::user()->id)->update([
                'verified' => $request->input('verified'),
            ]);
        }

        return back()->with('message', "Verifikasi Sedang Dalam Proses!");
    }

    public function viewPhoto(Request $input)
    {
        return back();
    }
}