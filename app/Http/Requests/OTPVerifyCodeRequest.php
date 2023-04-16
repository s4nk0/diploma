<?php

namespace App\Http\Requests;

use App\Enums\PhoneNumberEnum;
use App\Rules\OTPVerifyCodeRule;
use Illuminate\Foundation\Http\FormRequest;

class OTPVerifyCodeRequest extends FormRequest
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
            'phone_number'=>['required','regex:'.PhoneNumberEnum::REGEX->value],
            'verification_code'=>['required',new OTPVerifyCodeRule($this->phone_number)]
        ];
    }
}
