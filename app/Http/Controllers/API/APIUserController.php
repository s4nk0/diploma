<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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


}
