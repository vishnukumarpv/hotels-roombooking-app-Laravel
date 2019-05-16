<?php 
//vjx
Route::post('/bookings/vacate','Owner\OwnerController@roomVacated');
Route::post('bookings','Owner\OwnerController@getApi'); 
// Route::get('bookings','Owner\OwnerController@getApi'); 


Route::post('validate_coupon','Discount\DiscountController@checkCoupon'); 
// Route::get('validate_coupon','Discount\DiscountController@checkCoupon'); 

Route::prefix('ad')->group(function(){
    Route::post('coupon','Discount\DiscountController@adminGet');
});
