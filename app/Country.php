<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    //

 protected $table = 'countries';
 protected $primaryKey = 'id';
    function Events(){

    return $this->hasMany('App\Event','country_id','id');
    }
    function States(){

	// return $this->belongsTo('App\State');
    return $this->hasMany('App\State','country_id','id');

    }
}
