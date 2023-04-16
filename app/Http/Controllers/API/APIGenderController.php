<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Gender;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class APIGenderController extends Controller
{
    public function index(){
        return response()->json([
            'message' => 'Genders',
            'data' => [
                Gender::all()
            ]
        ]);
    }
}
