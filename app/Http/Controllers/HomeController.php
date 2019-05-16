<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\room;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms = room::latest()->paginate(6);
        return view('home',[ 'rooms'=>$rooms ]);
    }
}
