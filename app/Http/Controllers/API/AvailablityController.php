<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\room; 

class AvailablityController extends Controller
{
    public function check(Request $request)
    {
    	if( !$request->has('room') ){
    		return dd(0);
    	}

        $this->validate($request,[
            'checkin' => 'nullable|date|after:yesterday',
            'checkout' => 'nullable|date|after:checkin',
        ]);

    	$room_req = collect();

    	$room_req->room	=	$request->room;
        $dates = new \App\Helpers\VisHelper\Helper;

        $dates = $dates->validateDates([
            'checkin'       =>      $request->checkin,
            'checkout'       =>      $request->checkout,
        ]);
 
    	$room_req->checkin = $dates->checkin;
    	$room_req->checkout = $dates->checkout;
    	$room_req->rooms = $request->rooms;
    	$room_req->guests = $request->guests;


    	$room = new room;
    	$room = $room->where( "slug" , $room_req->room )->first();
  
     	if ( ! $room)
		{
		    return response()->json([
		    	'error'		=>	true,
		        'message'	=> 'Room not found',
		    ], 404);
		}

		$booked_rooms = $room->getBookedRoomCount( $room_req );

		$available_rooms = ( $room->total_rooms - $booked_rooms );

		$response = [
			"error"	=>	false,
			"total_rooms" => $room->total_rooms,
			"available_rooms"=> $available_rooms,
			"prices"	=>	[ $room->price_single, $room->price_double, $room->price_extra ],
			"max_occupancy" => $room->max_person,
			"available"		=>	( $available_rooms > 0 )? true : false,
			"dates"			=>	[ $room_req->checkin->toDateString() , $room_req->checkout->toDateString() ],
            "nights"        =>  $room_req->checkout->diffInDays( $room_req->checkin )
		];

		return response()->json($response);

    }
}
