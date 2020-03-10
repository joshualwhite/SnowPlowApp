<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $primaryKey = 'id';

    //Creates the relationship from Customer -> Route
    //A customer belongs to a route
    public function user(){
        return $this->belongsTo('App\Route');
    }
}
