<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * @param  $request
     * @return mixed
     */
    public function toResponse($request)
    {
        if (auth()->user()->role == "user") {
            return redirect()->intended("/");
        }
        if (auth()->user()->role == "admin") {
            return redirect()->intended("/admin");
        }
        if (auth()->user()->role == "company") {
            return redirect()->intended("/company");
        }
    }
}