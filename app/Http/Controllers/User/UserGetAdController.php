<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\GetAd\StoreAdGetRequest;
use App\Http\Requests\User\GetAd\UpdateAdGetRequest;
use App\Models\AdGenderType;
use App\Models\AdGet;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class UserGetAdController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth:sanctum',
            config('jetstream.auth_session'),
            'verified',
            'profile.complete'
        ])->except(['show']);
    }

    public function index()
    {
        $adGet = Auth::user()->adGet()->paginate(5);;
        return view('user.get-ad.index',compact('adGet'));
    }

    public function create()
    {
        $this->checkAccess('create',AdGet::class);
        $cities = City::all();
        $ad_gender_types = AdGenderType::all();
        return view('user.get-ad.create',compact('cities','ad_gender_types'));
    }

    public function store(StoreAdGetRequest $request)
    {
        $this->checkAccess('create',AdGet::class);
        $data = $request->validated();
        $data['user_id']= Auth::user()->id;

        $ad_get = AdGet::create($data);
        return redirect()->route('user.get_ad.show',['get_ad'=>$ad_get]);
    }

    public function show(AdGet $get_ad)
    {
        $get_ad->update(['views'=>$get_ad->views+1]);
       return view('user.get-ad.show',compact('get_ad'));
    }

    public function edit(AdGet $get_ad)
    {
        $cities = City::all();
        $ad_gender_types = AdGenderType::all();
        $this->checkAccess('update',$get_ad);
        return view('user.get-ad.edit',compact('get_ad','cities','ad_gender_types'));
    }

    public function update(UpdateAdGetRequest $request, AdGet $get_ad)
    {
        $this->checkAccess('update',$get_ad);
        $data = $request->validated();
        $get_ad->update($data);

        return redirect()->route('user.get_ad.show',['get_ad'=>$get_ad]);
    }

    public function destroy(AdGet $get_ad)
    {
        $this->checkAccess('delete',$get_ad);
        $get_ad->delete();
        return redirect()->route('user.get_ad.index')->with(['success'=>'Запись успешно удален!']);
    }
}
