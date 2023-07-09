<?php

namespace App\Http\Controllers\Admin;

use App\Models\Funding;
use App\Models\User;
use Illuminate\Http\Request;

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
        $funding = Funding::findOrFail($funding->id);
        $user = User::findOrFail($funding->customer_id);

        try {
            $funding = Funding::findOrFail($funding->id);
            $user = User::findOrFail($funding->customer_id);
            $filePath = storage_path('app/private/payment/' . $funding->order_photo);

            // Check if the file exists
            if (file_exists($filePath)) {
                // Get the file contents
                $fileContents = file_get_contents($filePath);
                $imageData = null;
                // Return a view to display the image
                return view('frontend.admin.funding.funding-details', compact('funding', 'user'))->with('imageData', base64_encode($fileContents));
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

        return redirect()->back()->with('message', "Status Verifikasi Order telah Diperbarui!");
    }

}