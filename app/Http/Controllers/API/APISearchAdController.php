<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class APISearchAdController extends Controller
{
    public function index(Request $request){
        return response()->json([
            'message' => 'Search ad',
            'data' => [
                Ad::with(['media','user'])->orderBy('created_at','desc')->paginate(5)
            ]
        ]);
    }

    public function show(Ad $ad){
        return response()->json([
            'message' => 'Search ad '.$ad->id,
            'data' => [
                $ad->load(['media','user','apartment_condition','gender_type','liked_users','apartment_bathrooms',
                    'apartment_bathrooms_types','apartment_furniture','apartment_furniture_status','apartment_facilities',
                    'apartment_bathroom_types','apartment_securities','window_directions','apartment_for'
                ])
            ]
        ]);
    }

    public function like(Ad $ad){
        if (!$ad->user_liked){
            $ad->liked_users()->attach(Auth::user());
            return response()->json([
                'message' => 'Success attached',
            ],Response::HTTP_ACCEPTED);
        }else{
            $ad->liked_users()->detach(Auth::user());
            return response()->json([
                'message' => 'Success detached',
            ],Response::HTTP_ACCEPTED);
        }
    }
}
