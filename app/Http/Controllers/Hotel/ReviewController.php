<?php

namespace App\Http\Controllers\Hotel;
use App\Http\Controllers\Controller; 

use App\Review;
use App\Room;
use Illuminate\Http\Request;

class ReviewController extends Controller
{

 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug, Request $request)
    {
        $this->validate($request,[
            'review' => 'required|min:10|max:390',
            'rating' => 'required|integer|min:0|max:5',
        ]); 
        $room = new Room;  
         
        $request->merge(['room_id' =>$room->where('slug',$slug)->firstOrFail()->id ]);

        auth()->user()->reviews()->create( $request->all() );

        Review::where('user_id',auth()->id())
                ->where('room_id',$request->room_id)
                ->where('rating','!=',$request->rating)
                ->update(['rating' => $request->rating ]);

        return back(); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(Review $review)
    {
        //
    }
}
