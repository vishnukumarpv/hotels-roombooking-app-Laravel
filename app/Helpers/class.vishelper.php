<?php 
namespace App\Helpers\VisHelper;

use Carbon\Carbon;

/**
 * 
 */
class Helper
{
	
	private $carbon;

	public function validateDates( $opts = array() )
	{


		$parms = array_merge([
				"checkin" => '',
				"checkout" => '',
                "toString" => false
				],$opts);

		$parms = (object)$parms;
		$parms->errors = [];

 

        $this->carbon = new Carbon; 

        if($parms->checkin == NULL ):
            $parms->checkin = $this->carbon->today();
        else:
            if(!$this->validateDate($parms->checkin)) 
                return $parms->errors = ['ERR'=>'Invalid date format'];
            $parms->checkin = $this->carbon->parse($parms->checkin);
        endif; 

        if($parms->checkout == NULL ):
             $parms->checkout = $parms->checkin->copy()->addDay(); 
        else:
            if(!$this->validateDate($parms->checkout)) 
                $parms->checkout = $parms->checkin->addDays(1);
            $parms->checkout = $this->carbon->parse($parms->checkout);
        endif;


        if( $parms->checkin->isPast() && !$parms->checkin->isToday() ){ 
            $parms->checkin = $this->carbon->today();
            $parms->errors = ['ERR'=>'This check in date is invalid'];
        }
 
        if( $parms->checkout->isPast() ){ 
            $parms->checkout = $this->carbon->tomorrow();
            $parms->errors = ['ERR'=>'This check out date is behind today'];
        }

        if($parms->checkout->lt($parms->checkin)){ 
            $parms->checkin = $this->carbon->today();
            $parms->checkout = $this->carbon->tomorrow();
            $parms->errors = ['ERR'=>'the check in date is greater than the checkout '];
        }

        if( $parms->toString == true){
            $parms->checkin = $parms->checkin->toDateString();
            $parms->checkout = $parms->checkout->toDateString();
        }

        return $parms;
	}


    function validateDate($date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }


    public function couponValidate( $coupon ){
        $discount = new \App\Discount;
        $discount->_coupon = $coupon;
        $coupon = $discount->checkCoupon();

        if($coupon == NULL)
            return false;

        $session_ =  session()->get('booking');
        $coupon->room_price = $session_['amount'];
        $coupon->valid = true;
        $coupon->message = '';

/*            dd($coupon->valid_to->isFuture() || $coupon->valid_to->isToday() , 
        $coupon->valid_from->isPast() || $coupon->valid_from->isToday()); */

        if( $coupon->valid_to->isFuture() || $coupon->valid_to->isToday() ):
            
            if( $coupon->valid_from->isPast() || $coupon->valid_from->isToday() ){
                
                if( $coupon->amount_min <= $coupon->room_price || $coupon->amount_min == NULL ):
                    if($coupon->percentage != NULL){
                        $coupon->reducted = $coupon->percentage * ( $coupon->room_price / 100);
            
                        if($coupon->max <  $coupon->reducted)
                                $coupon->reducted = $coupon->max;
            
                        $coupon->promo_price = $coupon->room_price - $coupon->reducted;
                    }
                    else{
                        
                            $coupon->reducted = $coupon->amount;
                            $coupon->promo_price = $coupon->room_price - $coupon->amount;
            
                    }
                else:
                    $coupon->valid = false;
                endif;

            }else{
                $coupon->valid = false;
                $coupon->message =  'Coupon will be active with in '.$coupon->valid_from->diffForHumans();
            }

        else:
            $coupon->valid = false;
            $coupon->message = 'Coupon expired '.$coupon->valid_to->diffForHumans();
        endif;
 
    return $coupon;
    }
    

    


}