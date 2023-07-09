<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investor;
use App\Models\Investment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function storeVerification(Request $request)
    {
        // $request->validate([
        //     'identity_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_selfie' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_number' => 'required',
        //     'identity_type' => 'required',
        // ]);

        if ($request->hasFile('identity_photo') && $request->hasFile('identity_selfie')) {
            $IDPhoto = $request->file('identity_photo');
            $SelfieIDPhoto = $request->file('identity_selfie');

            $filename = date('YmdHi') . '_' . $IDPhoto->getClientOriginalName();
            $filename1 = date('YmdHi') . '_' . $SelfieIDPhoto->getClientOriginalName();

            // Store the new images
            $IDPhoto->storeAs('private/verification/investor/identity_photo', $filename);
            $SelfieIDPhoto->storeAs('private/verification/investor/selfie_photo', $filename1);

            $data = [
                'user_id' => Auth::user()->id,
                'identity_type' => $request['identity_type'],
                'identity_number' => $request['identity_number'],
                'identity_photo' => $filename,
                'identity_selfie' => $filename1,
            ];

            $investor = Investor::where('user_id', Auth::user()->id)->first();

            if ($investor) {
                // Delete old images
                $oldIdentityPhoto = $investor->identity_photo;
                $oldIdentitySelfie = $investor->identity_selfie;

                if ($oldIdentityPhoto && Storage::exists('private/verification/investor/identity_photo/' . $oldIdentityPhoto)) {
                    Storage::delete('private/verification/investor/identity_photo/' . $oldIdentityPhoto);
                }

                if ($oldIdentitySelfie && Storage::exists('private/verification/investor/selfie_photo/' . $oldIdentitySelfie)) {
                    Storage::delete('private/verification/investor/selfie_photo' . $oldIdentitySelfie);
                }

                $investor->update($data);
            } else {
                Investor::create($data);
            }

            User::where('id', Auth::user()->id)->update([
                'verified' => $request->input('verified'),
            ]);
        }

        return back()->with('message', "Verifikasi Sedang Dalam Proses!");
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