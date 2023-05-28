<?php

namespace App\Http\Requests\Admin\AdGenderType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdGenderTypeRequest extends FormRequest
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
