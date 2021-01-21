<?php

namespace App\Http\Controllers;
use App\Country;
use App\Category;
use App\Type;
use App\Publisher;
use App\Event;
use App\City;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use DB;
use Validator;
use Auth;
use App\EventUser;

class FrontController extends Controller
{
	public function homePageData($request, $type='home'){
		
		$country = ($request->country) ? str_replace('_', ' ', str_replace('$', '&', $request->country)) : '';
		$city = ($request->city) ? str_replace('_', ' ', str_replace('$', '&', $request->city)) : '';
		
		if($country == '' && $type == 'home'){
			$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$_SERVER['REMOTE_ADDR']));
		    if($query && $query['status'] == 'success')
		    {
		       	$country =	$query['country'];
		       	$city =	$query['city'];
		    }else{
		    	$country = 'Pakistan';
		    	//$city =	($city == '') ? 'Islamabad' : $city;
		    }
		}
	   
		$data = [];
		$data['search']['country'] = $country;
		$data['search']['city'] = $city;
		$data['categories'] = Category::all();
		$data['cities'] = City::whereHas('state.country', function($q) use($country){
						    $q->where('name', 'like', $country);
						})->orderBy(DB::raw('RAND()'))->take(20)->get();
		$data['countries'] = Country::all()->random(20);
		return $data;
	}

	public function home(Request $request){

		$data = $this->homePageData($request);
		$country = $data['search']['country'];
		$data['featured_events'] = Event::with(['categories', 'city.state.country'])->whereHas('city.state.country', function($q) use($country){
		    $q->where('name', 'like', $country);
		})->where('is_active', 1)->where('is_featured', 1)->where('start_date','>=',date('Y-m-d'))->take(6)->get();
		$data['popular_events'] = Event::with(['categories', 'city.state.country'])->whereHas('city.state.country', function($q) use($country){
		    $q->where('name', 'like', $country)->where('start_date','>=',date('Y-m-d'));
		})->where('is_active', 1)->where('is_featured', 0)->where('start_date','>=',date('Y-m-d'))->take(24)->get();
		if($data['popular_events']->count() <= 0){
			$data['popular_events'] = Event::with(['categories', 'city.state.country'])->where('is_active', 1)->where('start_date','>=',date('Y-m-d'))->where('is_featured', 0)->where('start_date','>=',date('Y-m-d'))->take(24)->get();
		}
		
		$data['search']['country'] = '';
		$data['search']['city'] = '';
		return view('front.home')->with($data);
	}

	public function search(Request $request){

		$data = $this->homePageData($request , 'search');
		$country = $data['search']['country'];




		
		
		$city = $data['search']['city'];
		$category = ($request->category && $request->category != '') ? str_replace('_', ' ', str_replace('$', '&', $request->category)) : '';

		$url = '';
		$events = Event::with(['categories', 'city.state.country']);

		if(isset($country) && $country != ''){
			$events = $events->whereHas('city.state.country', function($q) use($country){
			    $q->where('name', 'like', $country);
			});
			$country = str_replace(' ', '_', str_replace('&', '$', $country));
			$data['search']['country'] = $country;
			$url = 'country='.$country;
		}

		if(isset($city) && $city != ''){
			
			$events = $events->whereHas('city', function($q) use($city){
			    $q->where('name', 'like', $city);
			});
			$city = str_replace(' ', '_', str_replace('&', '$', $city));
			$data['search']['city'] = $city;
			$url .= $url != '' ? '&city='.$city : 'city='.$city;
		}

		if($category != ''){
			$events = $events->whereHas('categories', function($q) use($category){
			    $q->where('name', 'like', $category);
			});
			$category = str_replace(' ', '_', str_replace('&', '$', $category));
			$data['search']['category'] = $category;
			$url .= $url != '' ? '&category='.$category : 'category='.$category;
		}

		$name = ($request->name && $request->name) ? str_replace('_', ' ', str_replace('$', '&', $request->name)) : '';
		if($name != ''){
			$events = $events->where(function($q) use($name){
				$q->where('title', 'like', "%".$name."%")->orWhere('organization_name', $name)->orWhere('keywords', 'like', "%".$name."%");
			});
			/*$name = str_replace(' ', '_', str_replace('&', '$', $name));*/
			$url .= $url != '' ? '&name='.$name : 'name='.$name;
		}
		
		$url = ($url != '') ? '?'.$url : $url;

		$events = $events->where('is_active', 1)->where('start_date','>=',date('Y-m-d'))->paginate(12);
		$events->withPath($url);
		$data['events'] = $events;
		$data['search']['category'] = $category;
		$data['search']['name'] = $name;
		$data['popular_events'] = Event::with(['categories', 'city.state.country'])->where('is_active', 1)->where('is_featured', 0)->where('start_date','>=',date('Y-m-d'))->take(24)->get();
		return view('front.search')->with($data);
	}

	public function about(){
		return view('front.about');
	}

	public function contact(){
		return view('front.contact');
	}

	public function policy(){
		return view('front.policy');
	}

    public function create(Request $request){
        $data = [
            'countries' => Country::all(),
            'categories' => Category::all(),
            'types' => Type::all(),
            'publishers' => Publisher::where('is_active', 1)->get()
        ];

    	return view('front.events.create')->with($data);
    }

    public function save(Request $request){
    	$validatedData = $request->validate([
	        'organization_name' => 'required|max:100',
	        'admin_email_address' => 'required|email|max:100',
	        'title' => 'required|max:100',
	        'category_ids' => 'required',
	        'type_id' => 'required',
	        'contact_person' => 'required',
	        'enquireis_email_address' => 'required|email|max:100',
	        'website_address' => 'required|max:100',
	        'start_date' => 'required',
	        'end_date' => 'required',
	        'abstract' => 'required|max:100',
	        'short_description' => 'required|max:500',
	        'keywords' => 'required||max:500',
	        'publisher_id' => 'required',
	        'other' => Rule::requiredIf( function () use ($request){
        		return $request->publisher_id == 'other';
    		}),
	    ]);

    	$event = Event::saveEvent($request);
		return redirect()->back()->with('success', 'Event saved successfully.');   
    }

    public function getEventDetails(Request $request, $eventId, $eventName){

    	$event = Event::with(['categories', 'city.state.country'])->findOrFail($eventId);
    	return view('front.events.detail')->with('event', $event);
    }

    public function addCategory(){

    	// Add categories
		$categoriesStr = "Agriculture & Forestry____Animals & Pets____Apparel & Clothing____Arts & Crafts____Auto & Automotive____Baby, Kids & Maternity____Banking & Finance____Building & Construction____Business Services____Education & Training____Electric & Electronics____Entertainment & Media____Environment & Waste____Fashion & Beauty____Food & Beverages____Home & Office____Hospitality____IT & Technology____Industrial Engineering____Logistics & Transportation____Medical & Pharma____Miscellaneous____Packing & Packaging____Power & Energy____Science & Research____Security & Defense____Telecommunication____Travel & Tourism____Wellness, Health & Fitness____";

		$categoriesIconsStr = "fa-leaf____fa-paw____fa-shopping-bag____fa-paint-brush____fa-car____fa-child____fa-usd____fa-building____fa-briefcase____fa-graduation-cap____fa-plug____fa-video-camera____fa-recycle____fa-circle____fa-cutlery____fa-home____fa-circle____fa-desktop____fa-industry____fa-truck____fa-medkit____fa-circle____fa-archive____fa-bolt____fa-flask____fa-shield____fa-phone____fa-plane____fa-heartbeat____";
			$categories = explode("____", rtrim($categoriesStr,"____"));
			$categoriesIcons = explode("____", rtrim($categoriesIconsStr,"____"));
			foreach ($categories as $key=>$name) {
				
				$user = Category::updateOrCreate(['name' => $name, 'icon_name' => $categoriesIcons[$key]], ['name' => $name]);
			}
    }

    public function addToWishList(Request $request){
    	$validator = Validator::make($request->all(), [
            'event_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
			    'message' => 'Event id is required.',
			    'options' => [],
			    'status' => 400
			]);
        }else{
        	
        	$user = Auth::user();
        	$addWishList = EventUser::updateOrCreate(['event_id' => $request->event_id, 'user_id' => $user->id], ['user_id' => $user->id]);
        	return response()->json([
			    'message' => 'Succfully added.',
			    'status' => 200
			]);
        }
    }
    
    public function way2_events_month($date, Request $request){
        
        $url ='';
        $date_ext  = explode('-',$date);
        $current = date('m');
        $events = Event::with(['categories', 'city.state.country']);
        if($current == $date_ext[1]){
            echo "Current Month";
             $lastMonth =  date('Y-m-t', strtotime($date));
             		$events = $events->where('is_active', 1)->where('start_date','>=',date('Y-m-d'))->where('start_date','<=',$lastMonth)->paginate(12);
             		
             		$url .= '?startdate='.date('Y-m-d').'&enddate='.$lastMonth;
        }
        else
        {
         
         $lastmonth = date('Y-m-t', strtotime($date));
         $firstdate = date('Y-m-01', strtotime($date));
         
         		$events = $events->where('is_active', 1)->where('start_date','>=',"$firstdate")->where('start_date','<=',"$lastmonth")->paginate(12);
         		$url .= '?startdate='.$firstdate.'&enddate='.$lastmonth;
         
        }
        
        
        // $data = $this->homePageData($request , 'search');
// 		$events = Event::with(['categories', 'city.state.country']);

		

// 		$events = $events->where('is_active', 1)->where('start_date','>=',date('Y-m-d'))->paginate(12);
// 		$events->withPath($url);
		$data['events'] = $events;
		$data['search']['category'] = '';
		$data['search']['name'] = '';
		$data['categories'] = Category::all();
		$data['popular_events'] = Event::with(['categories', 'city.state.country'])->where('is_active', 1)->where('is_featured', 0)->where('start_date','>=',date('Y-m-d'))->take(24)->get();
		return view('front.search')->with($data);
        
        
        
        
        
        
        
        
		
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
    }
}
