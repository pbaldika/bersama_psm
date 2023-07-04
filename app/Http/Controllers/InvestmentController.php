<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Project;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class InvestmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function investmentList()
    {
        $user = Auth::user(); // Get the currently authenticated user
        $userId = $user->id; // Get the user's ID

        // Retrieve investments made by the user
        $investments = Investment::where('user_id', $userId)->get();

        // Retrieve project IDs associated with the investments
        $projectIds = $investments->pluck('project_id');

        // Retrieve projects associated with the investments
        $projects = Project::whereIn('id', $projectIds)->get()->keyBy('id');

        return view('frontend.user.investment-made', ['investments' => $investments, 'projects' => $projects]);

    }



    public function calculateProfit(Request $request, Investment $investment)
    {
        $investment = Investment::find($investment->id);
        $project = Project::find($investment->project_id);

        $profit_all_investor = ($project->profit_margin_investor / 100) * $project->profit;
        $profit_investor = ($investment->total / $project->required_capital) * $profit_all_investor;

        return $profit_investor;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $input)
    {

        $project = Project::where('id', $input['project_id'])->first();
        $new_capital = $project->current_capital + $input['total'];

        // Update the current capital in the projects table
        $project->current_capital = $new_capital;
        $project->save();

        $paymentDeadline = Carbon::now()->addWeekdays(5);

        Investment::create([
            'total' => $input['total'],
            'profit' => $input['profit'],
            'status' => $input['status'],
            'payment_proof' => $input['payment_proof'],
            'user_id' => $input['user_id'],
            'project_id' => $input['project_id'],
            'payment_deadline' => $paymentDeadline,
        ]);

        return back()->with('message', 'Permintaan Investasi Kalian Berhasil Terbuat, Mohon Buat Pembayaran Agar Investasi Disetujui!');
    }

    public function addPhoto(Investment $investment)
    {
        try {
            // Retrieve the investment by ID and ensure the authenticated user is the owner
            $investment = Investment::where('id', $investment->id)
                ->where('user_id', auth()->user()->id)
                ->firstOrFail();

            return view('frontend.user.upload-image', ['investment' => $investment]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Investment not found or user is not the owner
            return redirect()->route('landing')->with('error', 'You are not authorized to access this investment.');
        }
    }

    public function uploadPhoto(Investment $investment, Request $request)
    {
        // $request->validate([
        //     'identity_photo' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_selfie' => 'required|image|mimes:png,jpg,jpeg|max:2048',
        //     'identity_number' => 'required',
        //     'identity_type' => 'required',
        // ]);

        if ($request->hasFile('image')) {
            $IDPhoto = $request->file('image');

            $filename = date('YmdHi') . '_' . $IDPhoto->getClientOriginalName();

            // Store the new images
            $IDPhoto->storeAs('private/payment/', $filename);

            $data = [
                'payment_proof' => $filename,
            ];

            $investment = Investment::where('id', $investment->id)->first();

            if ($investment) {
                // Delete old images
                $oldImage = $investment->image;

                if ($oldImage && Storage::exists('private/payment/' . $oldImage)) {
                    Storage::delete('private/payment/' . $oldImage);
                }

                $investment->update($data);
            } else {
                $investment->update($data);
            }
        }

        return back()->with('message', "Verifikasi Sedang Dalam Proses!");
    }
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
    //     ]);

    //     if ($request->file('image')) {
    //         $file = $request->file('image');
    //         $filename = date('YmdHi') . $file->getClientOriginalName();
    //         $file->move(public_path('public/Image'), $filename);
    //         Investment::findOrFail($investment->id)->update([
    //             'payment_proof' => $filename,
    //         ]);
    //     }

    //     return back()->with('message', "Image is Uploaded!");
    // }
    public function viewPhoto(Request $input)
    {
        return back();
    }

    public function verify(Investment $investment, Request $request)
    {
        Investment::findOrFail($investment->id)->update([
            'status' => $request['status'],
        ]);

        return redirect()->back()->with('message', "Status Verifikasi Investasi Diperbarui!");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Investment $investment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investment $investment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Investment $investment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Investment $investment)
    {
        //
    }
}