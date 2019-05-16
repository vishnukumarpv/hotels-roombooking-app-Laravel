<?php

namespace App\Http\Controllers\Booking;

use App\Booking;
use App\room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use \App\Rules\Notpast;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     *  
     *
     * @return \Illuminate\Http\Response
     */
    public function show($refference, Booking $booking)
    {   

 

        $booking = $booking->getBookingByRefference( $refference );

            if ( 
                    $booking->completed == 0 
                && (
                        $booking->check_in->isToday() == 1
                        || $booking->check_in->isPast() != 1
                    )
             ) {

             session([
                'booking_id'   =>  $booking->id
            ]);
             return redirect()->route('pay');
            } 
        return view('booking.paycomplete',[
            'booking' => $booking, 
            'is_admin'  => auth()->user()->hasRole('admin')
        ]);
    }


    public function showForOwner($refference)
    {
        $booking = new Booking;
        $booking = $booking->getBookingsForOwner()
            ->where('refference',$refference)
            ->firstOrFail();
        return view('booking.paycomplete',[
            'booking' => $booking, 
            'is_admin'  => 'owner'
        ]);
    }
 

    /**
     * Book a newly created resource in booking.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function book($slug, Request $request)
    {   
        $this->validate($request,[ 
            'room.*'         =>   'required|integer|min:1|max:8',
            'checkin'      =>   ['required','date',new Notpast],
            'checkout'        =>   ['nullable','date',new Notpast],
        ]); 

        $request->merge([
            'rooms'     =>      count($request->room)
        ]);

        $validater = new \App\Helpers\VisHelper\Helper;

        $dates = $validater->validateDates([
            'checkin'       =>      $request->checkin,
            'checkout'       =>      $request->checkout,
        ]);

        if( array_has($dates,['']))
        return back()->withInput()->withErrors(__('error occured'));
 
        $room = (new Room)->getRoom( $slug );

        $check_in = $request->checkin;
        $check_out = $request->checkout;
        $checkout = $request->query('checkout',$check_in);
// dd($request->check_in);


        if ( (int)$request->rooms > $room->total_rooms ) 
            return back()->withInput()->withErrors(__('hotel.booking.notenough'));
 

        $booked_count = $room->getBookedRoomCount($request);

        if( $booked_count >= $room->total_rooms 
            || ( $booked_count + $request->rooms ) > $room->total_rooms )  
            return back()->withInput()->withErrors(__('hotel.booking.noemptyrooms')); 

         
        $dates = (object)[]; 

        $dates->check_in  =    Carbon::parse($check_in);
        $dates->check_out  =    Carbon::parse($check_out);

 
        if( $dates->check_in->eq( $dates->check_out ) ){
            $dates->diff = 1;
        } else {
           $dates->diff = $dates->check_in->diffInDays( $dates->check_out );
        } 
        // return $room;

        // $amount->oneday = $request->rooms * $room->pernight; 

/*        if( $room->first_child == 1 )
            $amount->child = $amount->child - $room->child;*/

        $amount_total = 0;

        foreach ($request->room as $guest) {
                    if( $guest >= 1 ){
                        $amount_total = $amount_total + $room->price_single;
                    }

                    if( $guest >= 2 ){
                        $amount_total = $amount_total + $room->price_double;
                    }

                    if( $guest >= 3 ){
                        $amount_total = $amount_total + ($room->price_extra * ( $guest - 2));
                    }
        }

        $amount_total = $amount_total * $dates->diff;

        $booking = (object)[];

        $booking->room_id = $room->id;
        $booking->check_in = $check_in;
        $booking->check_out = $request->query('checkout',$check_in);
        $booking->amount = $amount_total;
        $booking->rooms = $request->rooms; 
        $booking->alignment = json_encode($request->room); 
        

            $request->session()->put( [
                'hasbooking'   =>  1,
                'booking' => (array)$booking
            ] );
 

        return redirect()->route('pay');
    }

 
    public function pay( Request $request)
    {  
        if($request->session()->get('hasbooking',0) == 0)
            return redirect()->route('profile');

        $session_ = $request->session()->get('booking');

        $booking = collect(); 
        $booking->check_in = Carbon::parse($session_['check_in']);
        $booking->check_out = Carbon::parse($session_['check_out']);
        $booking->amount = $session_['amount'];
        $booking->rooms = $session_['rooms']; 
        $booking->room_id = $session_['room_id']; 

        // $id = auth()->user()->rooms()->save($booking)->id;
 


        $room = Room::findOrFail( $booking->room_id );
 
        return view('booking.book',[
            'room'  =>  $room, 
            'booking' =>  $booking 
        ]); 


    }





/*    public function pay( Booking $booking)
    {
        $id = session()->get('booking_id'); 

        $booking = $booking->findOrFail($id);

         if( $booking->completed == 1 ){
            session()->forget('booking_id');
            return redirect()->route('booked',['refference' => $booking->refference]);
         }

         if($booking->check_in->isToday() != 1 && $booking->check_in->isPast() == 1){
            return 'faild to pay';
         }

        $room = (new Room)->findOrFail( $booking->room_id );
 
        return view('booking.book',[
            'room'  =>  $room, 
            'booking' =>  $booking 
        ]); 


    }*/

    public function completePay(Request $request, Booking $booking)
    {
        $this->validate($request,[
            'card_num'  =>  'required|integer',
            'cvv_num'   =>  'nullable|integer',
        ]);

        $coupon = $request->input('coupon_code',0);

        $session_ = $request->session()->get('booking',false);

        $booking->room_id = $session_['room_id'];
        $booked_room_count = $booking->roomCurBookingCount( );
        $room = $booking->room;

         if ( $booking->rooms > $room->total_rooms ) 
            return back();

        if ( $booked_room_count >= $room->total_rooms ) 
            return back(); 

        $amount = $session_['amount'];

        if($coupon != NULL){
            $coupon_ = new \App\Helpers\VisHelper\Helper;
            $coupon = $coupon_->couponValidate($coupon);

            if($coupon->valid==true){
                $amount = ( $coupon->promo_price < $amount )? $coupon->promo_price : $amount; 
                $booking->discount_id = $coupon->id;
            }
        }
    



         $data = [
            'bank_ref_id' => '1221',
            'card_no'      =>   $request->card_num,
            'cvv'      =>   $request->cvv_num,
            'name'      =>  'sample name',
            'bank'      =>  'Bank_name',
            'actual_amount'    =>  $session_['amount'],
            'coupon'    =>  $request->coupon_code,
         ];

        $booking->data = json_encode($data);

        $ref_id = env('APP_BOOK_REF_PRE')
            .\Carbon\Carbon::now()->timestamp
            .array_random([4,6,7,8])
            .'V'
            .$booking->id;

        $booking->check_in = $session_['check_in'];
        $booking->check_out = $session_['check_out'];
        $booking->amount = $amount;
        $booking->rooms = $session_['rooms']; 
        $booking->alignment = $session_['alignment']; 
        $booking->room_id = $session_['room_id']; 
         $booking->refference = $ref_id;
         $booking->completed = 1;
         
         // $booking->save(); 
        auth()->user()->rooms()->save($booking)->id;
 
         $request->session()->put('hasbooking',0);
         $request->session()->forget('booking');

 

         return redirect()->route('booked',['reference' => $ref_id]);
     
    }


 
    
}
