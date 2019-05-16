<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Booking; 


class OwnerController extends Controller
{
    public function index( )
    {
 
        
        //   $hotels =  auth()->user()->hotels()->select('id')->get();
        // $bookings = (new Booking)->getBookingsForOwner(2);

        // return $bookings;
  
        return view('owner.show' );
    }

    public function booking($booking)
    {
        $booking = Booking::where(['refference' => $booking])
        ->with(['room'=>function($q){
            $q->withOut('media');
            $q->with('hotel');
        }]) 
        ->firstOrFail(); 

        if($booking->room->hotel->user_id != auth()->id()) 
            return abort(404); 
        $today = \Carbon\Carbon::today();

        return view('owner.booking',['booking'=>$booking,'today'=>$today]);
    }

    public function getApi(Request $request)
    {
        $this->validate($request,[
            'page'  =>  'integer|nullable'
        ]);
        
        $bookings = (new Booking)->getBookingsForOwner(2);
        // dd( $bookings);

        $bookings->data = $bookings->each(function($booking,$key){
                $status = [
                    'today_checkout'    =>  0,
                    'past'    =>  0,
                    'future'    =>  0,
                    'in_room'    =>  0,
                ];
            if($booking->check_out->isToday())
                $status['today_checkout'] = 1 ; 
                
            if($booking->check_out->isPast() && $status['today_checkout'] != 1) 
                $status['past'] = 1 ; 
            elseif($status['today_checkout'] != 1)
                $status['future'] = 1;

            if($booking->check_in->isFuture()){
                $status['in_room'] = 1;
                $status['future'] = 0;
            }
            return $booking->status = $status;
 
        });

        // return($bookings->total());
        return  response()->json($bookings);
    }

    public function roomVacated(Request $request)
    {
        if($request->vacate != 1)
            return 0;
        $booking = (new Booking)->bookingsOwner()->where(['refference' => $request->ref]);
        $resp = ['success'=> false];
        if($request->vacate == 1){
            $booking->update(['vacated'=>1]) ;
            $resp = ['success'=> true ]; 
        }
        return response()->json($resp);
    }
}
