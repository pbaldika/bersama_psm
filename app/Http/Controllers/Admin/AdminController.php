<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Investment;
use App\Models\Project;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $investorCount = User::where('role', 'user')->count();
        $activeProjectCount = Project::where('progress_status', 'aktif')->count();
        $userNeedVerify = User::where('verified', 'request')->count();
        $investmentNeedVerify = Investment::where('status', 'request')->count();

        return view('frontend.admin.welcome', [
            'userCount' => $userCount,
            'investorCount' => $investorCount,
            'activeProjectCount' => $activeProjectCount,
            'userNeedVerify' => $userNeedVerify,
            'investmentNeedVerify' => $investmentNeedVerify,
        ]);
    }
}