<?php

namespace App\Http\Controllers\Admin;

use App\Models\Funding;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminFundingController extends Controller
{

    public function create()
    {
        return view('frontend.admin.funding.funding-create');
    }


    public function search(Request $request)
    {
        // Get the search query from the request
        $searchQuery = $request->input('funding-search');

        // Perform the search query on the users table
        $fundings = Funding::where('customerOrder', 'like', '%' . $searchQuery . '%')
            ->orWhere('status', 'like', '%' . $searchQuery . '%')
            ->orWhere('customerName', 'like', '%' . $searchQuery . '%')
            ->paginate(30);

        if ($fundings->isEmpty()) {
            return view('frontend.admin.funding.funding', ['fundings' => $fundings])->with('message', "User Tidak Ditemukan.");
        }
        return view('frontend.admin.funding.funding')->with(['fundings' => $fundings]);
    }

    public function listFunding()
    {
        $fundings = Funding::paginate(30);
        return view('frontend.admin.funding.funding', ['fundings' => $fundings]);
    }

    public function details(Funding $funding)
    {
        try {
            $funding = Funding::findOrFail($funding->id);
            $user = User::findOrFail($funding->user_id);
            $filePath = storage_path('app/private/order/' . $funding->order_photo);

            // Check if the file exists
            if (file_exists($filePath)) {
                // Get the file contents
                $fileContents = file_get_contents($filePath);
                $imageData = null;
                // Return a view to display the image
                return view('frontend.admin.funding.funding-details', compact('funding', 'user'))
                    ->with('imageData', base64_encode($fileContents));
            } elseif ($funding->order_photo == null) {
                $imageData = null;
                // File not found
                $errorMessage = 'User Belum Mengupload Bukti Gambar';
                return view('frontend.admin.funding.funding-details', compact('funding', 'user', 'imageData'))->with('errorMessage', $errorMessage);
            }
        } catch (\Exception $e) {
            $imageData = null;
            // Handle any exceptions that may occur
            $errorMessage = 'Bukti Pembayaran Belum Ada';
            return view('frontend.admin.funding.funding-details', compact('funding', 'user', 'imageData'))->with('errorMessage', $errorMessage);
        }
    }


    public function verify(Funding $funding, Request $input)
    {
        $funding->update([
            'status' => $input['status'],
        ]);

        if ($funding->order_photo != null) {

            $sourcePath = storage_path('app/private/verification/investor/identity_photo/' . $funding->order_photo);
            $destinationPath = public_path('pro');
            Storage::copy($sourcePath, $destinationPath);

        }

        Project::create([
            'name' => $funding->fundName,
            'description' => $funding->description,
            'required_capital' => $funding->fund_required,
            'progress_status' => 'aktif',
            'project_photo' => $funding->order_photo,
            'company_id' => $funding->user_id,
            'profit_margin_bersama' => $funding->profit_margin_user,
            'profit_margin_investor' => $funding->profit_margin_user,
            'profit' => null,
            'funding_id' => $funding->id,
        ]);


        return redirect()->back()->with('message', "Status Verifikasi Funding telah Diperbarui! Projek Telah Ditambahkan!");
    }
}