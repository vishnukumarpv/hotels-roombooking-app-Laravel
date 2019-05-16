<?php
 
namespace App\Http\Controllers\Hotel;
use App\Http\Controllers\Controller; 

use App\room;
use App\hotel;
use App\Amenity; 
use App\Http\Requests\RoomRequest;
use Illuminate\Http\Request;
 
// use Carbon\Carbon;

class RoomController extends Controller
{


 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return 1;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($hotel_slug, hotel $hotel)
    {
        $hotel = auth()->user()
            ->hotels()
            ->where(['slug' => $hotel_slug])
            ->firstOrFail(); 

        $amenities = Amenity::all();
        
        return view('rooms.create',[
            'hotel' =>  $hotel,
            'amenities' =>  $amenities
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($hotel_slug, RoomRequest $request)
    { 
 
        $hotel = auth()->user()
            ->hotels()
            ->where(['slug' => $hotel_slug])
            ->firstOrFail(); 

        $slug = (new Room)->uniqueSlug( $request->name ); 

        $request->merge([ 
                'slug'  =>  $slug,
                // 'first_child' => request('first_child',false)
            ]); 


        $rooms = $hotel->rooms();

        $room = $rooms->create($request->all());

        $amenities = array_values($request->get('amenities',[])); 

        $room->amenity()->sync( $amenities ); 

        if($request->has('images')){
                $room->storeImage($request->file('images'));
        }
        
        return redirect()
                ->route('room',['slug'=> $slug])
                ->withSuccess(__('hotel.room.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\room  $room
     * @return \Illuminate\Http\Response
     */
    public function show($slug, room $room,Request $request)
    {
        $room = $room->where('slug',$slug)->firstOrFail(); 
 
        $total_booked = $room->getTotalBookings();

        $user_rating = $room->reviews->where('user_id', auth()->id())->first();

        $dateval = new \App\Helpers\VisHelper\Helper;

        $formData = collect();

        $formData = $dateval->validateDates([
            'checkin'   =>  $request->checkin,
            'checkout'   =>  $request->checkout,
            'toString'  =>  true,
        ]);

        $formData->rooms = $request->input('rooms',1);
        $formData->guests = $request->input('guests',1);

        $formData->room = $room->slug; 

        return  view('rooms.show',[
            'room' => $room,
            'reviews' => $room->reviews,
            'current_user_rating' => $user_rating,
            'total_booked'      =>   $total_booked ,
            'amenities' =>  $room->amenity,
            'formData' => $formData,
            ]) ;
    } 
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit($slug )
    { 
        $room = auth()->user()->getRoom($slug);  
        $ame = $room->amenity->values()->pluck('name','id');
        // dd($ame->has(3) );
        return view('rooms.edit',[
            'room'  =>  $room,
            'hotel' => $room->hotel,
            'amenities' => Amenity::all(),
            'amenities_room' => $ame ,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\room  $room
     * @return \Illuminate\Http\Response
     */
    public function update($slug, RoomRequest $request, room $room)
    {

        $room = auth()->user()->getRoom($slug); 
        $room->update($request->only([
            'name','description','total_rooms','pernight','max_person'
        ]));

        $amenities = array_values($request->get('amenities',[])); 

        $room->amenity()->sync( $amenities );
        return redirect()
                ->route('room',['slug'=>$room->slug])
                ->withSuccess(__('hotel.room.updated')); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $room = auth()->user()->getRoom($slug);
        $room->delete();
        return redirect()
            ->route('room_home')
            ->withSuccess(__('hotel.room.deleted'));
    }
}
