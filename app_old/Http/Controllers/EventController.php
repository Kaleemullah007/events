<?php

namespace App\Http\Controllers;
use App\Country;
use App\Category;
use App\Type;
use App\Publisher;
use App\State;
use App\City;
use App\Event;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use App\EventsCategory;
use App\Http\Requests\SaveEventRequest;
use Datatables;
use Auth;

class EventController extends Controller
{
    public function create(Request $request, $id = 0){
        $data = [
            'countries' => Country::all(),
            'categories' => Category::all(),
            'types' => Type::all(),
            'publishers' => Publisher::where('is_active', 1)->get()
        ];

        if(isset($id) && $id > 0){
        	$data['event'] = Event::with('categories')->findOrFail($id);
        	if(isset($data['event']->id)){
        		$data['event']->start_date = date('d/m/d', strtotime($data['event']->start_date));
		    	$data['event']->end_date = date('d/m/d', strtotime($data['event']->end_date));
		    	$data['event']->abstract = date('d/m/d', strtotime($data['event']->abstract));
	        	$data['category_ids'] = isset($data['event']['categories']) && count($data['event']['categories']) > 0 ? $data['event']['categories']->pluck('id')->toArray() : [];	
        	}
        }

    	return view('admin.events.create')->with($data);
    }

    public function save(SaveEventRequest $request){
    
    	$event = Event::saveEvent($request);
		if(isset($request->id) && intval($request->id) > 0){
			return redirect()->back()->with('success', 'Event updated successfully.');   
		}else{
			return redirect('/admin/events/listing')->with('success', 'Event added successfully.');   
		}
    }

    public function getStates(Request $request){
    	$validator = Validator::make($request->all(), [
            'country_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
			    'message' => 'Country id is required.',
			    'options' => [],
			    'status' => 400
			]);
        }else{
        	$options = '<option selected="selected" value="">Select State</option>';
        	$states = State::where('country_id', $request->country_id)->get();
        	if(isset($states) && $states->count() > 0){
        		foreach ($states as $key => $state) {
        			$options .= '<option value="'.$state->id.'">'.$state->name.'</option>';
        		}
        	}
        	return response()->json([
			    'message' => 'States list.',
			    'options' => $options,
			    'status' => 200
			]);
        }
    }

    public function getCities(Request $request){
    	$validator = Validator::make($request->all(), [
            'state_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
			    'message' => 'Country id is required.',
			    'options' => [],
			    'status' => 400
			]);
        }else{
        	$options = '<option selected="selected" value="">Select City</option>';
        	$states = City::where('state_id', $request->state_id)->get();
        	if(isset($states) && $states->count() > 0){
        		foreach ($states as $key => $state) {
        			$options .= '<option value="'.$state->id.'">'.$state->name.'</option>';
        		}
        	}
        	return response()->json([
			    'message' => 'States list.',
			    'options' => $options,
			    'status' => 200
			]);
        }
    }

    public function listing(){
    	return view('admin.events.listing');
    }

    public function fetchList(){
        
        $user = Auth::user();
        $event  = Event::with(['categories'])
            		->select(['id','title','start_date','end_date', 'is_active']);
        if($user->role_id != 1){
            $event = $event->where(['created_by' => $user->id]);
        }		
		return datatables()->of($event)
	        ->editColumn('start_date', function($event){
	        	return $date = Carbon::parse($event->start_date)->isoFormat('Do MMM YYYY');
	        })
	        ->editColumn('end_date', function($event){
	        	return $date = Carbon::parse($event->start_date)->isoFormat('Do MMM YYYY');
	        })
	        ->addColumn('categories', function($event){
	        	$categorys = '';
	           	if(isset($event->categories) && count($event->categories) > 0){
	           		$categorys = $event->categories->map(function($category) {
	                    return $category->name;
	                })->implode(',');
	           	}
	            return $categorys;
	        })
	        ->addColumn('action', function($event) use($user){
	            $buttons = '<div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">';
                                    if($user->role_id == 1){
                                        $buttons .= '<a class="dropdown-item btnDelete" href="#" data-id="'.$event->id.'"><i class="fas fa-times text-orange-red"></i>Delete</a>';
                                    }
                                   
                                    $buttons .= '<a class="dropdown-item" href="/admin/events/'.$event->id.'/edit"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>';   
                                    
                                    if($event->is_active == 1){
                                        $buttons .= '<a class="dropdown-item btnStatus" href="#" data-id="'.$event->id.'" data-status="0"><i class="fas fa-times text-orange-red"></i>Disable</a>';
                                    }else{
                                        $buttons .= '<a class="dropdown-item btnStatus" href="#" data-id="'.$event->id.'" data-status="1"><i class="fas fa-cogs text-dark-pastel-green"></i>Enable</a>';
                                    }
                $buttons .= '</div>
                        </div>';
                return $buttons;
	        })->make(true);
    }

    public function delete(Request $request){
    	$validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
			    'message' => 'Event id is required.',
			    'status' => 400
			]);
        }else{
        	$event = Event::findOrFail($request->id);
            $event->categories()->detach();
            $event->delete();
        	return response()->json([
			    'message' => 'Event delted successfully.',
			    'status' => 200
			]);
        }
    }

    public function changeStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Event id is required.',
                'status' => 400
            ]);
        }else{
            $user = Event::where('id', $request->id)->update(['is_active' => $request->status]);
            return response()->json([
                'message' => 'Status updated successfully.',
                'status' => 200
            ]);
        }
    }

    public function favouriteEventsListing(){
        return view('admin.events.favouriteEventsLisiting');
    }

    public function fetchFavouriteEvents(){
    
        $user = Auth::user()->events()->select(['events.id', 'event_user.id as event_user_id', 'organization_name', 'title', 'event_user.created_at']);            
        return datatables()->of($user)
            ->editColumn('created_at', function($user){
                return $date = Carbon::parse($user->created_at)->isoFormat('Do MMM YYYY');
            })
            ->addColumn('action', function($event){
                return '<div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item btnDelete" href="#" data-id="'.$event->event_user_id.'"><i class="fas fa-times text-orange-red"></i>Delete</a>
                            </div>
                        </div>';
            })
            ->make(true);
    }

    public function deleteFavouriteEvent(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Event id is required.',
                'status' => 400
            ]);
        }else{
            $res = Auth::user()->events()->wherePivot('id', $request->id)->detach();
            return response()->json([
                'message' => 'Event delted successfully.',
                'status' => 200
            ]);
        }
    }
}
