<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;
use App\Http\Traits\UploadImageTrait;

class Event extends Model
{
	use UploadImageTrait;

	public function users(){

        return $this->belongsToMany('App\User');
    }

    public function categories(){
    	
    	return $this->belongsToMany('App\Category', 'events_categories', 'event_id', 'category_id');
    }

    public function city(){
    	return $this->belongsTo('App\City');
    }

    public function Country(){
    	return $this->belongsTo('App\Country');
    }

    public static function saveEvent($data){

    	if(isset($data->id) && intval($data->id) > 0){
    		$event = self::findOrFail($data->id);
    		$event->categories()->detach();
    	}else{
    		$event = new Event();
    	}

    	$publisherId = $data->publisher_id;
    	if($data->publisher_id == 'other' && isset($data->other)){
    		$publisher = new Publisher();
    		if ($data->hasFile('publisher_logo')) {
    			$_this = new self;
	            $publisher->logo = $_this->UploadImage($data->file('publisher_logo'), 'logos/publishers/');
		    }
    		$publisher->name = $data->other;
    		$publisher->save();
    		$publisherId = $publisher->id;
    	}

    	if ($data->hasFile('logo')) {
    		$_this = new self;
    		$event->logo = $_this->UploadImage($data->file('logo'), 'logos/events/', $event->logo);
	    }
	    
	    $event->organization_name = $data->organization_name;
	    $event->admin_email_address = $data->admin_email_address;
	    $event->title = $data->title;
	    /*$event->category_id = $data->category_id;*/
	    $event->type_id = $data->type_id;
	    $event->country_id = (isset($data->country_id)) ? $data->country_id : null;
	    $event->state_id = (isset($data->state_id)) ? $data->state_id : null;
	    $event->city_id = (isset($data->city_id)) ? $data->city_id : null;
	    $event->organizing_society = (isset($data->organizing_society)) ? $data->organizing_society : null;
	    $event->contact_person = $data->contact_person;
	    $event->enquireis_email_address = $data->enquireis_email_address;
	    $event->website_address = $data->website_address;
	    $event->start_date = date('Y-m-d', strtotime(str_replace('/', '-', $data->start_date)));
	    $event->end_date = date('Y-m-d', strtotime(str_replace('/', '-', $data->end_date)));
	    $event->abstract = date('Y-m-d', strtotime(str_replace('/', '-', $data->abstract)));
	    $event->short_description = $data->short_description;
	    $event->keywords = $data->keywords;
	    $event->keynote_speakers = (isset($data->keynote_speakers)) ? $data->keynote_speakers : null;
	    $event->conference_highlights = (isset($data->conference_highlights)) ? $data->conference_highlights : null;
	    $event->venue = (isset($data->venue)) ? $data->venue : null;
	    $event->publisher_id = $publisherId;
	    $event->is_featured = (isset($data->is_featured) && $data->is_featured == 1) ? 1 : 0;
	    $user = Auth::user();
	    if(isset($user->id)){
	    	$event->created_by = $user->id;
	    }

	    $event->save();

	    $now = Carbon::now()->toDateTimeString();
	    $categoriesData = [];
	    foreach ($data->category_ids as $key => $categoryId) {
	    	$categoriesData[] = array('event_id' => $event->id, 'category_id' => $categoryId, 'created_at' => $now, 'updated_at' => $now);
	    }
		//$eventsCategory = EventsCategory::insert($categoriesData);
		$eventsCategory = $event->categories()->attach($categoriesData);
		return $event;
    }
}
