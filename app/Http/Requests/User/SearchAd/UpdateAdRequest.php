<?php

namespace App\Http\Requests\User\SearchAd;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdRequest extends FormRequest
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
            'price'=>'required|integer',
            'price_com'=>'nullable|integer',
            'price_pledge'=>'nullable|integer|min:1|max:100',
            'floor'=>'nullable|integer',
            'floor_from'=>'nullable|integer',
            'square_general'=>'required|integer',
            'square_living'=>'nullable|integer',
            'square_kitchen'=>'nullable|integer',
            'apartment_condition_id'=>'nullable|integer|exists:apartment_conditions,id',
            'kitchen_studio'=>'nullable',
            'city_id'=>'required|integer|exists:cities,id',
            'coordinates'=>'required',
            'location'=>'required',
            'images' => 'nullable|max:5',
            'images.*' => 'required|mimes:jpg,jpeg,png,bmp|max:20000',[
                'image_file.*.required' => 'Please upload an image',
                'image_file.*.mimes' => 'Only jpeg,png and bmp images are allowed',
                'image_file.*.max' => 'Sorry! Maximum allowed size for an image is 20MB',
            ],
            'ad_gender_type_id'=>'nullable|exists:ad_gender_types,id',
            'apartment_furniture_status_id' => 'nullable|integer|exists:apartment_furniture_statuses,id',
            'apartmentFurniture_ids' => 'nullable',
            'apartmentFurniture_ids.*' => 'required|integer|exists:apartment_furniture,id',
            'apartmentFacilities_ids' => 'nullable',
            'apartmentFacilities_ids.*' => 'required|integer|exists:apartment_facilities,id',
            'apartmentBathroomTypes_ids'=> 'nullable',
            'apartmentBathroomTypes_ids.*'=> 'required|integer|exists:apartment_bathroom_types,id',
            'bathrooms_count'=> 'nullable|integer',
            'apartmentBathrooms_ids'=> 'nullable',
            'apartmentBathrooms_ids.*'=> 'required|integer|exists:apartment_bathrooms,id',
            'apartmentSecurities_ids'=>'nullable',
            'apartmentSecurities_ids.*'=>'required|integer|exists:apartment_securities,id',
            'balconies_count'=>'nullable|integer',
            'loggias_count'=>'nullable|integer',
            'roommate_count'=>'required|integer',
            'windowDirections'=>'nullable',
            'windowDirections.*'=>'required|integer|exists:window_directions,id',
            'apartmentFor_ids'=>'nullable',
            'apartmentFor_ids.*'=>'required|integer|exists:apartment_for,id',
            'description'=>'nullable',
            'contact_name'=>'required|string',
            'phone_number'=>'required|numeric',
            'contact_email'=>'required|email',
        ];
    }
}
