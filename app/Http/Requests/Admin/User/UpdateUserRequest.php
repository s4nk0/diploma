<?php

namespace App\Http\Requests\Admin\User;

use App\Enums\PhoneNumberEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class   UpdateUserRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_id'=>['required','integer','exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            'gender_id' => ['required', 'integer', 'exists:genders,id'],
            'phone_number' => ['nullable', Rule::unique('users')->ignore($this->user_id),'regex:'.PhoneNumberEnum::REGEX->value],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'password' => ['nullable'],
        ];
    }
}
