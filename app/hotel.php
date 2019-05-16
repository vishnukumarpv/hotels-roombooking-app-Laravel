<?php

namespace App;
// use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\ImageManagerStatic as Image;

class hotel extends Model
{ 
    protected $fillable = ['name', 'description','address','street','city','email','phone','web','cat_id','slug','created_by'];

    // protected  $primaryKey = 'slug';  
    /** 
        unique slugs genarating
    */
    protected $slug_guards = ['create','room'];


    // public $incrementing = false;

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

    public function rooms( )
    {
        return $this->hasMany('App\Room' );
        // return $this->hasmany('App\Room','hotel_id','id');
    }

    public function user($value='')
    {
        return $this->belongsTo('App\User');
    }

    public function media()
    {
        return $this->hasMany('App\Media','relation_id','id');
    }

/*    public function getImage($image)
    {
        return $this->media()->where()
    }*/

    public function storeImage( $image)
    {
        // $img = $image->store('public/images/hotel');
        $image_resize = Image::make($image->getRealPath());              
        $image_resize->resize(300, 300);
        $img_name = uniqid().'_'.$image->getClientOriginalName();
        $img_path = public_path('images/hotel/' . $img_name);
        $image_resize->save( $img_path );

        $this->media()->create([
            'filename' => $img_name ,
            'original_filename' => '',
            'mime_type' => $image->getMimeType(),
            'type'      =>  'cover',
            'relation_id' => $this->id,
            'relation_with' => 'hotel',
        ]);
        return $img_name;
    }



    public function search($city='', $pg = 4)
    {
        // return $this->where( 'city', $city )
        //     ->with(['rooms'=> function( $query ){

        //     }]) 
        //     ->simplePaginate(1);

        return $this->join('rooms','hotels.id', '=' ,'rooms.hotel_id')
                ->select('rooms.*','hotels.city')
                ->where('hotels.city' , $city )
                ->with('media')
                ->latest()
                ->paginate($pg);
 
    }







}
