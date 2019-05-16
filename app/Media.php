<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = [ 
    	'filename' , 'original_filename', 'mime_type', 'relation_with','type'
    	 ];
}
