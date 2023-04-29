<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\AdGenderType;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiAdGenderTypeController extends Controller
{
    public function index(){
        $ad_gender_types = AdGenderType::all();

        return response()->json([
            'success'=>true,
            'message' => 'Ad gender types',
            'data' => [
                $ad_gender_types

            ]
        ]);
    }
}
