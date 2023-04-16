<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdGet;
use Illuminate\Support\Facades\Auth;

class UserLikedAdController extends Controller
{
    public function index(){
        $search_ad = collect(Auth::user()->liked_ad);
        $get_ad = collect(Auth::user()->liked_ad_gets);
        $result = $search_ad->merge($get_ad);
        $result_count = $result->count();
        $result = $result->paginate(5);
        return view('user.liked',compact('result_count','result'));
    }
}
