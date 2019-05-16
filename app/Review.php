<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['rating','review','room_id'];
    protected $dates = ['created_at'];
    protected $with = ['user'];

    public function room($value='')
    {
    	return $this->belongsTo('App\Room');
    }


    public function user($value='')
    {
    	return $this->belongsTo('App\User');
    }


}
