<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    public function country(){
    	return $this->belongsTo('App\Country');
    }

    public function City(){
    	return $this->hasMany('App\City','state_id','id');
    	// return $this->belongsTo('App\City');
    }
}
