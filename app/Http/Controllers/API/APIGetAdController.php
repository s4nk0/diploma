<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdGet;
use Illuminate\Http\Request;

class APIGetAdController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'Ad get',
            'data' => [
                AdGet::with('user')->orderBy('created_at','desc')->paginate(5)
            ]
        ]);
    }

    public function show(AdGet $adGet){
        return response()->json([
            'message' => 'Ad get ' .$adGet->id,
            'data' => [
                $adGet->load(['user','liked_users','gender_type']),
            ]
        ]);
    }
}
