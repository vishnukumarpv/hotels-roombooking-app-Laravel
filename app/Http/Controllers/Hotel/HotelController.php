<?php

namespace App\Http\Controllers\Hotel;
use App\Http\Controllers\Controller; 
use App\Http\Requests\HotelRequest;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\hotel;
use App\User;
use App\Roles;

class HotelController extends Controller
{
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(hotel $hotel) {

        $hotels = $hotel->latest()
                ->with(['media'=> function($query){
                    $query->where('type','cover');
                }])
                ->paginate(6);

        return view('hotels.home',[ 
            'hotels' => $hotels
        ]);
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    { 
        return view('hotels.create',['user' => $user]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user, HotelRequest $request)
    { 

        $slug = (new hotel)->uniqueSlug( $request->name );


        $request->merge([ 
                'cat_id' => 1,
                'slug' => $slug,
                'created_by' => Auth::id(), 
            ]); 

        $hotel = $user->hotels()->create( $request->all() );

        $role_id = Roles::where('name','owner')->first()->id; 

        $user->roles()->syncWithoutDetaching([$role_id]);

        if($request->has('images')){
                $img = $hotel->storeImage($request->file('images'));
        }
 

        return redirect()
                ->route('hotel',['hotel'=>$slug])
                ->withSuccess(__('hotel.main.created'));
    }

    /**
     *Display the specified resource.
     *
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    { 
        $hotel = hotel::where('slug',$slug)->firstOrFail(); 
        return view('hotels.show',[ 'hotel' => $hotel,'rooms' => $hotel->rooms ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function edit($hotel)
    {
        $hotel = auth()->user()->hotels()
        ->where('slug',$hotel)
        ->firstOrFail(); 

        return view('hotels.edit',[ 'hotel' => $hotel ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function update( $hotel, HotelRequest $request)
    {
        $request->rules(['images'=>'nullable']);
        auth()->user()
            ->hotels()
            ->where('slug',$hotel)
            ->update($request->only([
               'name', 'description','address','street','city','email','phone','web'
            ]));
            
            return redirect()
                ->route('hotel',['hotel'=>$hotel])
                ->withSuccess(__('hotel.main.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\hotel  $hotel
     * @return \Illuminate\Http\Response
     */
    public function destroy(hotel $hotel)
    {
        //
    }
}
