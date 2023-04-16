<?php

namespace App\Http\Controllers;

use App\Interfaces\AdGetSearchRepository;
use App\Interfaces\AdSearchRepository;
use App\Interfaces\SearchRepository;
use App\Models\Ad;
use App\Models\AdGenderType;
use App\Models\AdGet;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SearchController extends Controller
{
    public function index( Request $request,AdSearchRepository $searchRepository,AdGetSearchRepository $adGetSearchRepository, $search = ''){
        $ad_gender_types = AdGenderType::all();
        $cities = City::all();

        $validator = Validator::make($request->all(), [
            'city_id' => ['nullable', 'integer', 'exists:cities,id'],
            'roommate_count'=>'nullable|integer',
            'rooms_count'=>'nullable|integer',
            'price_from'=>'nullable|integer',
            'price_to'=>'nullable|integer',
            'bathrooms_count'=>'nullable|integer',
            'balconies_count'=>'nullable|integer',
            'loggias_count'=>'nullable|integer',
            'floor_from'=>'nullable|integer',
            'floor'=>'nullable|integer',
            'square_general'=>'nullable|integer',
            'square_living'=>'nullable|integer',
            'square_kitchen'=>'nullable|integer',
            'kitchen_studio'=>'nullable|numeric|max:1|min:0',
            'ad_gender_type_id'=>'nullable|integer|exists:ad_gender_types,id',
        ]);

        if ($validator->fails()){
            return redirect()->route('search')
                ->withErrors($validator->errors())
                ->withInput();
        }

        $filters = [
            'price_from' => @$_GET['price_from'],
            'price_to' => @$_GET['price_to'],
            'rooms_count' => @$_GET['rooms_count'],
            'ad_gender_type_id' => @$_GET['ad_gender_type_id'],
            'city_id' => @$_GET['city_id'],
            'roommate_count' => @$_GET['roommate_count'],
            'bathrooms_count' => @$_GET['bathrooms_count'],
            'balconies_count' => @$_GET['balconies_count'],
            'loggias_count' => @$_GET['loggias_count'],
            'floor' => @$_GET['floor'],
            'floor_from' => @$_GET['floor_from'],
            'square_general' => @$_GET['square_general'],
            'square_living' => @$_GET['square_living'],
            'square_kitchen' => @$_GET['square_kitchen'],
            'kitchen_studio' => @$_GET['kitchen_studio'],
        ];


        $search_ad = (@$_GET['category'] == 'search_ad' || @$_GET['category']===null) ? collect($searchRepository->search($search,$filters)) : collect([]);

        $get_ad = (@$_GET['category'] == 'get_ad' || @$_GET['category']===null) ? collect($adGetSearchRepository->search($search)) : collect([]);
        $result = $search_ad->merge($get_ad);

        $result_count = $result->count();
        $result = $result->paginate(5);

        return view('pages.search',
            compact(
                'result',
                'result_count',
                'ad_gender_types',
                'search',
                    'cities'
            ));
    }
}
