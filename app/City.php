<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function state(){
    	return $this->belongsTo('App\State');
    }
      function EventCity(){

    return $this->hasMany('App\Event','city_id','id');
    }
}
