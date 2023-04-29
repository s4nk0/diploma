<?php

namespace App\Http\Controllers;

use App\Interfaces\AdGetSearchRepository;
use App\Interfaces\AdSearchRepository;
use App\Interfaces\SearchRepository;
use App\Models\Ad;
use App\Models\AdGenderType;
use App\Models\AdGet;
use App\Models\City;
use App\Repositories\SearchAds;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class SearchController extends Controller
{
    public function index( Request $request,SearchAds $searchAds, $search = ''){
        $ad_gender_types = AdGenderType::all();
        $cities = City::all();

        $result = $searchAds->searchResult($request,$search);

        $result_count = $result['count'];
        $result = $result['result'];

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
