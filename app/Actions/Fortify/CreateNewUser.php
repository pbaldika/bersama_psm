<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'telephone'=> ['required', 'string', 'max:30', 'unique:users'],
            'gender'=> ['required', 'string', 'max:20'],
            'address'=> ['required', 'string', 'max:300'],
            'dob'=> ['required', 'date'],
            'password' => $this->passwordRules(),
            'role'=> ['required', 'string', 'max:20'],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'telephone'=> $input['telephone'],
            'gender'=> $input['gender'],
            'address'=> $input['address'],
            'dob'=> $input['dob'],
            'password' => Hash::make($input['password']),
            'role'=> $input['role'],
        ]);
    }
}
