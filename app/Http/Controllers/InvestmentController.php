<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Investment;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;

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
        $investments = DB::table('investments')
            ->where('user_id', '=', auth()->user()->id)
            ->join('projects', 'investments.project_id', '=', 'projects.id')
            ->get(['investments.id', 'investments.total', 'investments.status', 'projects.name', 'projects.description']);
        return view('frontend.user.investment-made', ['investments' => $investments]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $input)
    {
        $investment = Investment::create([
            'total' => $input['total'],
            'profit' => $input['profit'],
            'status' => $input['status'],
            'payment_proof' => $input['payment_proof'],
            'user_id' => $input['user_id'],
            'project_id' => $input['project_id'],
        ]);

        return back();
    }

    public function addPhoto(Investment $investment)
    {
        $investment = Investment::findOrFail($investment->id);
        return view('frontend.user.upload-image', ['investment' => $investment]);
    }
    public function uploadPhoto(Investment $investment, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($request->file('image')) {
            $file = $request->file('image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/Image'), $filename);
            Investment::findOrFail($investment->id)->update([
                'payment_proof' => $filename,
            ]);
        }

        return back()->with('message', "Image is Uploaded!");
    }
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