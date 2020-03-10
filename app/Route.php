<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    public $primaryKey = 'id';

    //Return the customers assigned to a route
    public function customers() {
        return $this->hasMany('App\Customer');
    }
}
