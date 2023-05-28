<?php

namespace App\Http\Requests\Admin\ApartmentSecurity;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApartmentSecurityRequest extends FormRequest
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
            'title'=>'required|string'
        ];
    }
}
