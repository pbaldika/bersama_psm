<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function update(){
        return view('frontend.user.profile');
    }

    public function profile(Request $id){
        
    }
}
