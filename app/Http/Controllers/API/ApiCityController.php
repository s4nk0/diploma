<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class ApiCityController extends Controller
{
    public function index(){
        $cities = City::all();

        return response()->json([
            'success'=>true,
            'message' => 'Cities',
            'data' => [
                $cities

            ]
        ]);
    }
}
