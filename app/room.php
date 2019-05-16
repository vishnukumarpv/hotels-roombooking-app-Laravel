<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class room extends Model
{ 

    protected $fillable = [
        'name','description','total_rooms','slug','max_person',
        'price_single','price_double','price_extra'
    ];

    
    protected $with = 'media';



    /** 
        unique slugs genarating
    */
        
    protected $slug_guards = ['create','room'];
 

    public function contains($slug='', $value)
    {  
    	if(in_array($value, $this->slug_guards)) return true;

    	if($this->where($slug,$value)->count() > 0) return true;
    	return false;
    }


    public function uniqueSlug($value, $_column='slug')
    { 
    	$i = 0;
    	$max = 9999;

        $slug_v =  str_slug($value,'_'); 

         while($this->contains($_column,$slug_v)){
            $slug_v = $slug_v.'_'. rand(1000,9999);
            $i++;
            if($i==6000) $max = 9999999999999;
        } 
        return $slug_v;
    }

    public function reviews()
    {
        return $this->hasmany('App\Review');
    }


    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function getRoom($slug='')
    {
        return $this->where('slug',$slug)->firstOrFail();
    }


    public function hotel()
    {
        return $this->belongsTo('App\Hotel','hotel_id','id');
    }

    public function bookings( )
    {
        return $this->hasmany('App\Booking');
    }

    public function getBookedRoomCount($request)
    { 
        // $request = $request->only(['check_in','checkout']);
        return $this->bookings()
        ->where('completed',1)
        ->where('vacated',0)
        ->where(function($query) use($request){ 
            $query->where([
                ['check_in','<=',$request->checkin],
                ['check_out','>=',$request->checkin] 
            ])
            ->orWhere([
                    ['check_in','<=',$request->checkin],
                    ['check_out','>=',$request->checkout] 
            ])
            ->orWhere([
                    ['check_in','>=',$request->checkin],
                    ['check_out','<=',$request->checkout] 
            ]);
        }) 
        ->sum('rooms');
    }

    public function getTotalBookings()
    {
        return $this->bookings()->where('completed',1)->sum('rooms');
    }

    public function amenity()
    {
        return $this->belongsToMany('App\Amenity','amenity_room','room_id','amenity_id');
    }

    public function hasAmenity($amenity='') :bool
    {
        return $this->amenity->where('name',$amenity)->isNotEmpty();
    }



    public function media()
    {
        return $this->hasmany('App\Media','relation_id','id');
    }

    public function thumb()
    {
        return $this->media()->first();
    }

    public function storeImage( $image)
    {
        // $img = $image->store('public/images/room');

    $image_resize = Image::make($image->getRealPath());              
    $image_resize->resize(740, 480);
    $image_resize->encode('jpg',72);
    // $image_resize->stream()->__toString();
    $img_name = uniqid().'_'.$image->getClientOriginalName();
    $img_path = public_path('public\images\room\\' . $img_name);
    $image_resize->save( $img_path );
/*    $image = new UploadedFile($image_resize);
    $img = $image->store('public/images/room');*/
    // $path = Storage::put('file1121.jpg',  $image_resize , 'public');
    // $path = Storage::putFile('avatars', $image_resize->stream()->__toString());
  
        $this->media()->create([
            'filename' => $img_name ,
            'original_filename' => '',
            'mime_type' => $image->getMimeType(),
            'type'      =>  'cover',
            'relation_id' => $this->id,
            'relation_with' => 'room',
        ]);
    }
 
}

