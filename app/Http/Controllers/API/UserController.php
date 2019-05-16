<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Roles;
class UserController extends Controller
{
    public function roles(Request $request)
    { 
         $user = new User( );
         $user = $user->find($request->user);
        //  return $user->roles(); 
        $role_id = Roles::where('name','admin')->first()->id; 
        //  $user->roles()->sync([$role_id => $request->admin]);
         if($request->admin)
            $user->roles()->attach($role_id);
            else
            $user->roles()->detach($role_id);

           $user->verified = 0;
         if($request->admin || $request->verified)
            $user->update(['verified'=>1]) ;
         $user->save; 

         
    	return response()->json(['succes' => true]); 
    }
}
