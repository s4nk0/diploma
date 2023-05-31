<?php

namespace App\Http\Controllers\User;

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
use Illuminate\Support\Facades\Auth;

class UserSearchAddController extends Controller
{

    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
            'profile.complete'
        ])->except(['show']);;
    }

    public function index()
    {

        $ad = Auth::user()->ad()->withForModeration()->paginate(5);

        return view('user.search-ad.index', compact('ad'));
    }


    public function create()
    {
        $this->checkAccess('create',Ad::class);
        $apartmentConditions = ApartmentCondition::all();
        $cities = City::all();
        $apartmentFurniture = ApartmentFurniture::all();
        $apartmentFacilities = ApartmentFacilities::all();
        $apartmentBathroomTypes = ApartmentBathroomType::all();
        $apartmentFurnitureStatuses = ApartmentFurnitureStatus::all();
        $apartmentBathrooms = ApartmentBathroom::all();
        $apartmentSecurities = ApartmentSecurity::all();
        $windowDirections = WindowDirection::all();
        $apartmentFor = ApartmentFor::all();
        $ad_gender_types = AdGenderType::all();
        return view('user.search-ad.create', compact('apartmentConditions','cities',
            'apartmentFurniture','apartmentFacilities','apartmentBathroomTypes','apartmentFurnitureStatuses',
            'apartmentBathrooms','apartmentSecurities','windowDirections','apartmentFor','ad_gender_types'));
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
        if ($ad->status_moderation_id !== 1){
            return redirect()->route('user.search_ad.index');
        }
        return redirect()->route('user.search_ad.show',['search_ad'=>$ad]);
    }

    public function show(Ad $search_ad)
    {
        $search_ad->updateQuietly(['views'=>$search_ad->views+1]);

        return view('user.search-ad.show', compact('search_ad'));
    }

    public function edit($search_ad)
    {
        $search_ad = Ad::withForModeration()->find($search_ad);
        $this->checkAccess('update',$search_ad);
        $ad_gender_types = AdGenderType::all();
        $apartmentConditions = ApartmentCondition::all();
        $cities = City::all();
        $apartmentFurniture = ApartmentFurniture::all();
        $apartmentFacilities = ApartmentFacilities::all();
        $apartmentBathroomTypes = ApartmentBathroomType::all();
        $apartmentFurnitureStatuses = ApartmentFurnitureStatus::all();
        $apartmentBathrooms = ApartmentBathroom::all();
        $apartmentSecurities = ApartmentSecurity::all();
        $windowDirections = WindowDirection::all();
        $apartmentFor = ApartmentFor::all();
        return view('user.search-ad.edit', compact('apartmentConditions','cities',
            'apartmentFurniture','apartmentFacilities','apartmentBathroomTypes','apartmentFurnitureStatuses',
            'apartmentBathrooms','apartmentSecurities','windowDirections','apartmentFor','search_ad','ad_gender_types'));
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

        if ($search_ad->status_moderation_id !== 1){
            return redirect()->route('user.search_ad.index');
        }
        return redirect()->route('user.search_ad.show',['search_ad'=>$search_ad]);
    }

    public function destroy($search_ad)
    {
        $search_ad = Ad::withForModeration()->find($search_ad);
        $this->checkAccess('delete',$search_ad);
        $search_ad->delete();
        return redirect()->route('user.search_ad.index')->with(['success'=>'Запись успешно удален!']);
    }
}
