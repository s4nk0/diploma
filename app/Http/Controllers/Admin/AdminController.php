<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use App\Models\AdGet;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $userCount = User::count();
        $adCount = Ad::count();
        $adGetCount = AdGet::count();
        $viewsCount = AdGet::sum('views')+Ad::sum('views');
        $adByCities = Ad::selectRaw('count(id) as count,city_id')->groupby('city_id')->with('city')->orderBy('count','desc')->limit(10)->get();
        $adGetByCities = AdGet::selectRaw('count(id) as count,city_id')->groupby('city_id')->orderBy('count','desc')->limit(10)->get();

        return view('admin.pages.index',compact('userCount', 'adCount','adGetCount', 'viewsCount','adByCities','adGetByCities'));
    }
}
