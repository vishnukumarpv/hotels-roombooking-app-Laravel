<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function rooms( )
    {
        return $this->hasmany('App\Room');
    }

    public function room()
    {
        return $this->hasManyThrough(
                        'App\Room',
                        'App\Hotel',
                        'user_id',
                        'hotel_id',
                        'id',
                        'id'
                    );
    }

 

    public function getRoom($slug='')
    {
        return $this->room()->where('rooms.slug',$slug)->firstOrFail();
    }


    public function hotels( )
    {
        return $this->hasmany('App\Hotel');
    }

    public function reviews( )
    {
        return $this->hasmany('App\Review');
    }

    public function rating( )
    {
        return $this->hasmany('App\Review');
    }

    public function bookings()
    {
        return $this->hasmany('App\Booking');
    }

    public function roles( )
    {
        return $this->belongsToMany('App\Roles','roles_user','user_id','role_id');
    }

    public function hasRole($role='') :bool
    {
        return $this->roles->where('name',$role)->isNotEmpty();
    }

    public function bookingsForOwner()
    {
        return $this->bookings->where();
    }

 


/*    public function bookingsForOwner()
    {
        return $this->hasManyThrough(
                        'App\Room',
                        'App\Hotel',
                        'user_id',
                        'hotel_id',
                        'id',
                        'id'
                    );
    }*/
}
