<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function update()
    {
        return view('frontend.user.profile');
    }

    public function profile(Request $id)
    {

    }
}