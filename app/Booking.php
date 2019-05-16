<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\room;

class Booking extends Model
{
    
    protected $dates = ['check_in','check_out'];
    protected $with = 'user';

 

    public function room( )
    {
    	return $this->belongsTo('App\room');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function hotel( )
    {
        return $this->room()->with(['hotel'=> function($query){
            // $query->where('user');
        }]);
    }

/*     public function hasHotel()
    {
        return $this->hasManyThrough('App\Hotel','App\room','hotel_id','id')
    }
 */


    public function roomCurBookingCount()
    {
        return $this->where([
            'completed'=>'1',
            'room_id' => $this->room_id
        ])
        ->whereRaw('check_out >= CURDATE()')
        ->count();
    }

/*    public function getBookingsForOwner()
    {
    	return $this->hasOne('App\Room');
    }*/


    public function getBookingByRefference($refference)
    { 
        $user = auth()->user(); 
        if( $user->hasRole('admin') ){
            $booking = $this;
        }else{

            $booking = $user->bookings();
                            
        }

        return $booking->where( ['refference' => $refference] )
                    ->with(['room'=>function($query){
                                $query->without('media');
                                $query->with(['hotel'=>function($qu){
                                    $qu->select(['id','name','slug']);
                                }]);
                    }])->firstOrFail();;

    }

    public function bookingsOwner(){
        $hotels =  auth()->user()->hotels()->get();
        $hotels_ids = $hotels->pluck('id');
        $rooms = Room::whereIn('hotel_id',$hotels_ids)->withOut('media')->get();
        $rooms_ids = $rooms->pluck('id') ;
        return $this->whereIn('room_id',$rooms_ids)->with(['room'=>function($q){
                $q->withOut('media');
        }]);
    }

    public function getBookingsForOwner($pgnt = '')
    {
        return $this->bookingsOwner()
        ->latest()
        ->paginate($pgnt); 
    }
}
