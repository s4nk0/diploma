<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetAd\StoreAdGetRequest;
use App\Http\Requests\User\GetAd\UpdateAdGetRequest;
use App\Models\Ad;
use App\Models\AdGet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

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

    public function store(StoreAdGetRequest $request)
    {
        $this->checkAccess('create',AdGet::class);
        $data = $request->validated();
        $data['user_id']= Auth::user()->id;

        $ad_get = AdGet::create($data);
        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $ad_get
            ]
        ],Response::HTTP_ACCEPTED);
    }

    public function update(UpdateAdGetRequest $request, AdGet $get_ad)
    {
        $this->checkAccess('update',$get_ad);
        $data = $request->validated();
        $get_ad->update($data);

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $get_ad
            ]
        ],Response::HTTP_ACCEPTED);
    }

    public function destroy(AdGet $get_ad)
    {
        $this->checkAccess('delete',$get_ad);
        $get_ad->delete();

        return response()->json([
            'success'=>true,
            'message' => 'Запись успешно удален!',
        ],Response::HTTP_ACCEPTED);
    }
}
