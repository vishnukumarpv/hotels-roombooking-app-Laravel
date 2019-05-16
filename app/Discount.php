<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    //
    protected $dates =['valid_from','valid_to'];
    public $_coupon;

    public function checkCoupon( ){
        // $coupon = collect();
       return $this->where([
            'coupon'    =>  $this->_coupon,
            'active'    =>  1,
            ]) 
        ->first();  
    }
    
}
