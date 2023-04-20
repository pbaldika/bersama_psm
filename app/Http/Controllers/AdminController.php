<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        return view('frontend.admin.welcome');
    }

    public function user(){
        $users = User::paginate(30);
        return view('frontend.admin.user', ['users' => $users]);
    }

    public function userProfile(User $user){
        $user = User::findOrFail($user->id);
        return view('frontend.admin.user-profile', ['user' => $user]);
    }
}
