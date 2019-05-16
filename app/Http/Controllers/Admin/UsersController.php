<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User; 
use App\Roles; 

class UsersController extends Controller
{
    public function show(User $user)
    {
		// return $user->roles()->get(); 
    	return view('admin.users.user',[
    		'user'	=>	$user,
    		'hotels'	=>	$user->hotels,
    		'bookings'	=>	$user->bookings()->count(),
            // 'roles'     =>  Roles::all(),
    	]);
    }

    public function bookings(User $user)
    { 
    	$bookings = $user->bookings()->latest()->paginate(10);
    	return view('admin.users.bookings',['bookings' => $bookings]);
    }
}
