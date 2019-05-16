<?php

namespace App\Http\Controllers\Discount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Discount;

class DiscountController extends Controller
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

    public function adminIndex(){
        $discounts =  Discount::latest()->paginate(2);
        return view('admin.discounts.show',['discounts'=> $discounts]);
    }
    public function adminGet(Request $request){
        $discount = Discount::find($request->coupon);
        $discount->valid_from_ = $discount->valid_from->toDateString() ;
        $discount->valid_to_ = $discount->valid_to->toDateString() ;
        return $discount;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkCoupon(Request $request)
    {
        $this->validate($request,[
            'coupon' => 'required'
        ]); 

        $helper = new \App\Helpers\VisHelper\Helper;  

        $coupon = $helper->couponValidate( $request->coupon );
        // sleep(2);
        if( !$coupon )
            return 0;

        return response()
        ->json([
            "valid"     =>  $coupon->valid,
            "data"      =>  $coupon->only(['reducted','promo_price','percentage'])
        ]);
    }

  

 
    

}
