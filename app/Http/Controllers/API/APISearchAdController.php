<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Illuminate\Http\Request;

class APISearchAdController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'Search ad',
            'data' => [
                Ad::with('media')->orderBy('created_at','desc')->paginate(5)
            ]
        ]);
    }
}
