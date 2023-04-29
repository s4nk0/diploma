<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Repositories\SearchAds;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Symfony\Component\HttpFoundation\Response;

class ApiSearchController extends Controller
{
    public function search( Request $request,SearchAds $searchAds, $search = ''){
        $result = $searchAds->searchResult($request,$search);

        if (!gettype($result)  =='array' ){
            return  $result;
        }

        return response()->json([
            'success'=>true,
            'message' => 'Success',
            'data' => [
                $result

            ]
        ],Response::HTTP_ACCEPTED);
    }
}
