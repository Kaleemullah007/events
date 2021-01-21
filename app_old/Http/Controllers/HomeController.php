<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Event;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [];
        
        $irole =  Auth::user()->role_id;
        $iId =  Auth::user()->id;
        if($irole == 1){
            $data['type'] = "Admin";
            $data['users'] = User::count();
            $data['events'] = Event::count();
        }else{
            $data['type'] = "Owner ";
            $data['users'] = 0; //User::count();
            $data['events'] = Event::where('created_by',$iId)->count();
        }
        $data['role'] = $irole;
        
        
        
        
        return view('admin.dashboard')->with($data);
    }
}
