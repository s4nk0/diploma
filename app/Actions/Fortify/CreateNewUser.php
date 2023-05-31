<?php

namespace App\Actions\Fortify;

use App\Enums\PhoneNumberEnum;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['nullable',Rule::unique('users'), 'regex:'.PhoneNumberEnum::REGEX->value],
            'gender_id' => ['required', 'integer', 'exists:genders,id'],
            'password' => $this->passwordRules(),
//            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

         $user = User::create([
            'name' => $input['name'],
            'gender_id' => $input['gender_id'],
            'phone_number' => @$input['phone_number'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

         $user->roles()->attach(2);

        return $user;
    }
}
