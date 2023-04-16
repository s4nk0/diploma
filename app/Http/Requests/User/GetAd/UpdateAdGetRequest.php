<?php

namespace App\Http\Requests\User\GetAd;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdGetRequest extends FormRequest
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
            'rooms_count'=>'required|integer',
            'roommate_count'=>'required|integer',
            'price'=>'required|integer',
            'price_from'=>'required|integer',
            'city_id'=>'required|integer|exists:cities,id',
            'coordinates'=>'required',
            'location'=>'required',
            'animals'=>'nullable|boolean',
            'ad_gender_type_id'=>'nullable|exists:ad_gender_types,id',
            'description'=>'required',
            'contact_name'=>'required|string',
            'phone_number'=>'required|numeric',
            'contact_email'=>'required|email',
        ];
    }
}
