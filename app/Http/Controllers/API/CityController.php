<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\hotel;

class CityController extends Controller
{
    //

    public function city(Request $request)
    {
    	if (!$request->has('city')) {
    		return 0;
		}
		$city = $request->city;

    	$hotel = new hotel;

    	$cities = $hotel
    		->where('city','like',$city.'%')
    		->select('city')
    		->distinct()
            ->take(5)
    		->get();

    	// $cities = $cities->pluck('city');



    	return response()->json($cities);

    }
}
