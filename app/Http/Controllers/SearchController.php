<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cookie;
use App\hotel;
use Carbon\Carbon;
use App\Helpers\VisHelper\Helper;

class SearchController extends Controller
{
	private $hotel;

	function __construct()
	{
		$this->hotel = new hotel;
	}


    public function index(Request $request)
    { 
        
        $this->validate($request,[
            'checkin' => 'nullable|date|after_or_equal:date()',
            'checkout' => 'nullable|date|after:checkin',
        ]); 
        $carbon = new Carbon;
 
 
    	$rooms = $this->hotel->search($request->city); 

        $helper = new Helper;

        $dates = $helper->validateDates([
                    'checkin' => $request->query('checkin', ''),
                    'checkout' => $request->query('checkout', '')
                ]); 
        if($dates->errors != NULL)
            return redirect()->route('home')->withErrors(_('Not available'));
 
        $js = collect([]);
        $js->city = $request->query('city', 'Dubai');
        $js->rooms = $request->query('rooms', 1);
        $js->rooms = ($js->rooms > 3 || $js->rooms < 1 )? 1 : $js->rooms;
        $js->checkin = $dates->checkin->toDateString();
        $js->checkout = $dates->checkout->toDateString();

    	return view('search',['rooms' => $rooms ,'request' => $request, 'js' => $js ]);
    }

    public function api(Request $request)
    {
 
    	return  response()
                    ->json( $this->hotel->search($request->city, 4) );
    }
}
