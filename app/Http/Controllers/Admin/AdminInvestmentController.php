<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Investment;
use App\Models\Project;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class AdminInvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

    public function verify(Investment $investment, Request $request)
    {

        // $project = Project::find($request['project_id']);
        // $newCapital = $project->current_capital + $investment->total;
        // return dd($newCapital);

        if ($request['status'] == "active") {
            $project = Project::find($request['project_id']);
            $newCapital = $project->current_capital + $investment->total;

            $project->update([
                'current_capital' => $newCapital,
            ]);
        }

        Investment::findOrFail($investment->id)->update([
            'status' => $request['status'],
        ]);

        return redirect()->back()->with('message', "Status Verifikasi Investasi Diperbarui!");

    }

}