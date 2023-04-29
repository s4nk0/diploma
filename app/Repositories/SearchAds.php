<?php

namespace App\Repositories;

use App\Interfaces\AdGetSearchRepository;
use App\Interfaces\AdSearchRepository;
use App\Models\AdGenderType;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SearchAds
{
    private  AdSearchRepository $searchRepository;
    private  AdGetSearchRepository $adGetSearchRepository;
    private static $instance;

    public function __construct(AdSearchRepository $searchRepository, AdGetSearchRepository $adGetSearchRepository)
    {
        $this->searchRepository = $searchRepository;
        $this->adGetSearchRepository = $adGetSearchRepository;
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self(
                app(AdSearchRepository::class),
                app(AdGetSearchRepository::class)
            );
        }

        return self::$instance;
    }

    public function searchResult(Request $request,$search = ''){


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

            if ($request->wantsJson()) {
                return response()->json([
                    'success'=>false,
                    'message' => 'Fail',
                    'data' => [
                        $validator->errors()
                    ]
                ],Response::HTTP_UNPROCESSABLE_ENTITY);
            }

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


        $search_ad = (@$_GET['category'] == 'search_ad' || @$_GET['category']===null) ? collect($this->searchRepository->search($search,$filters)) : collect([]);

        $get_ad = (@$_GET['category'] == 'get_ad' || @$_GET['category']===null) ? collect($this->adGetSearchRepository->search($search,$filters)) : collect([]);
        $data = $search_ad->merge($get_ad);
        $result['count'] =  $data->count();
        $result['result'] = $data->paginate(5);


        return $result;
    }
}
