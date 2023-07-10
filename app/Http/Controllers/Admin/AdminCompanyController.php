<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\User;

class AdminCompanyController extends Controller
{
    public function showVerify(User $user)
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

    public function verify(User $user, Request $request)
    {
        User::findOrFail($user->id)->update([
            'verified' => $request['verified'],
        ]);

        return redirect()->back()->with('message', "Status Verifikasi User Diperbarui");
    }
}