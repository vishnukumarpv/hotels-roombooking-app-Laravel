<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class AdminController extends Controller
{

	public function show()
	{	

		$users = User::count();

		return view('admin.index',[
			'users'	=>	$users
		]);

	}

	public function users(User $users)
	{
		return view('admin.users.list',[ 
			'users'	=>	$users->latest()->paginate(15),
		]);
	}
}
