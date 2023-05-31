<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\SearchAd\StoreAdRequest;
use App\Http\Requests\User\SearchAd\UpdateAdRequest;
use App\Models\Ad;
use App\Models\AdGenderType;
use App\Models\ApartmentBathroom;
use App\Models\ApartmentBathroomType;
use App\Models\ApartmentCondition;
use App\Models\ApartmentFacilities;
use App\Models\ApartmentFor;
use App\Models\ApartmentFurniture;
use App\Models\ApartmentFurnitureStatus;
use App\Models\ApartmentSecurity;
use App\Models\City;
use App\Models\WindowDirection;
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

    public function edit($search_ad){
        $search_ad = Ad::withForModeration()->find($search_ad);
        $this->checkAccess('update',$search_ad);
        return response()->json([
            'message' => 'Search ad '.$search_ad->id,
            'data' => [
                $search_ad->load(['media','user','apartment_condition','gender_type','liked_users','apartment_bathrooms',
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

    public function store(StoreAdRequest $request)
    {
        $this->checkAccess('create',Ad::class);
        $data = $request->validated();
        $data['user_id']= Auth::user()->id;
        $ad = Ad::create($data);

        if ($request->images){
            foreach ($request->images as $image){
                $ad
                    ->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        if ($request->apartmentFurniture_ids && count($request->apartmentFurniture_ids)){
            $ad->apartment_furniture()->attach($request->apartmentFurniture_ids);
        }

        if ($request->apartmentFacilities_ids && count($request->apartmentFacilities_ids)){
            $ad->apartment_facilities()->attach($request->apartmentFacilities_ids);
        }

        if ($request->apartmentBathroomTypes_ids && count($request->apartmentBathroomTypes_ids)){
            $ad->apartment_bathroom_types()->attach($request->apartmentBathroomTypes_ids);
        }

        if ($request->apartmentBathrooms_ids && count($request->apartmentBathrooms_ids)){
            $ad->apartment_bathrooms()->attach($request->apartmentBathrooms_ids);
        }

        if ($request->apartmentSecurities_ids && count($request->apartmentSecurities_ids)){
            $ad->apartment_securities()->attach($request->apartmentSecurities_ids);
        }

        if ($request->windowDirections && count($request->windowDirections)){
            $ad->window_directions()->attach($request->windowDirections);
        }

        if ($request->apartmentFor_ids && count($request->apartmentFor_ids)){
            $ad->apartment_for()->attach($request->apartmentFor_ids);
        }

        return response()->json([
        'success'=>true,
        'message' => 'Success',
        'data' => [
            $ad
        ]
    ],Response::HTTP_ACCEPTED);
    }

    public function update(UpdateAdRequest $request, $search_ad)
    {
        $search_ad = Ad::withForModeration()->find($search_ad);
        $this->checkAccess('update',$search_ad);
        $data = $request->validated();
        $search_ad->update($data);

        $ad = $search_ad;

        if ($request->images){
            foreach ($request->images as $image){
                $ad
                    ->addMedia($image)
                    ->toMediaCollection('images');
            }
        }

        if ($request->apartmentFurniture_ids && count($request->apartmentFurniture_ids)){
            $ad->apartment_furniture()->sync($request->apartmentFurniture_ids);
        }

        if ($request->apartmentFacilities_ids && count($request->apartmentFacilities_ids)){
            $ad->apartment_facilities()->sync($request->apartmentFacilities_ids);
        }

        if ($request->apartmentBathroomTypes_ids && count($request->apartmentBathroomTypes_ids)){
            $ad->apartment_bathroom_types()->sync($request->apartmentBathroomTypes_ids);
        }

        if ($request->apartmentBathrooms_ids && count($request->apartmentBathrooms_ids)){
            $ad->apartment_bathrooms()->sync($request->apartmentBathrooms_ids);
        }

        if ($request->apartmentSecurities_ids && count($request->apartmentSecurities_ids)){
            $ad->apartment_securities()->sync($request->apartmentSecurities_ids);
        }

        if ($request->windowDirections && count($request->windowDirections)){
            $ad->window_directions()->sync($request->windowDirections);
        }

        if ($request->apartmentFor_ids && count($request->apartmentFor_ids)){
            $ad->apartment_for()->sync($request->apartmentFor_ids);
        }

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $ad
            ]
        ],Response::HTTP_ACCEPTED);
    }

    public function destroy($search_ad)
    {
        $search_ad = Ad::withForModeration()->find($search_ad);
        $this->checkAccess('delete',$search_ad);
        $search_ad->delete();
        return response()->json([
            'success'=>true,
            'message' => 'Запись успешно удален!',
        ],Response::HTTP_ACCEPTED);
    }

    public function relationDates(){
        $data['apartmentConditions'] = ApartmentCondition::all();
        $data['cities'] = City::all();
        $data['apartmentFurniture'] = ApartmentFurniture::all();
        $data['apartmentFacilities'] = ApartmentFacilities::all();
        $data['apartmentBathroomTypes'] = ApartmentBathroomType::all();
        $data['apartmentFurnitureStatuses'] = ApartmentFurnitureStatus::all();
        $data['apartmentBathrooms'] = ApartmentBathroom::all();
        $data['apartmentSecurities'] = ApartmentSecurity::all();
        $data['windowDirections'] = WindowDirection::all();
        $data['apartmentFor'] = ApartmentFor::all();
        $data['ad_gender_types'] = AdGenderType::all();

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $data
            ]
        ]);
    }
}
