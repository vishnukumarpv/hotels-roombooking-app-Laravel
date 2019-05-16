<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    const ROLE_ADMIN = 'admin';
    const ROLE_SUP_ADMIN = 'sup_admin';
    const ROLE_HOTEL_OWNER = 'owner'; 
    
}
