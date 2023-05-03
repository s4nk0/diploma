<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;
use Symfony\Component\HttpFoundation\Response;

class APIUserController extends Controller
{
    public function update(Request $request, UpdatesUserProfileInformation $updater){
        $updater->update($request->user(), $request->all());

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                'user'=>$request->user(),
            ]
        ],Response::HTTP_ACCEPTED);
    }


    public function userSearchAd(){

        $ad = Auth::user()->ad->paginate(5);

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $ad
            ]
        ]);
    }

    public function userGetAd(){
        $adGet = Auth::user()->adGet->paginate(5);

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $adGet
            ]
        ]);
    }

    public function userLiked(){
        $search_ad = collect(Auth::user()->liked_ad);
        $get_ad = collect(Auth::user()->liked_ad_gets);
        $result['result'] = $search_ad->merge($get_ad);
        $result['count'] = $result['result']->count();
        $result['result'] = $result['result']->paginate(5);

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $result
            ]
        ]);
    }

}
