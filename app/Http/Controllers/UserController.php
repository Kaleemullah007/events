<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Request;
use Auth;
use App\Country;
use App\Http\Requests\ProfileRequest;
use App\Http\Traits\UploadImageTrait;
use Hash;
use Validator;

class UserController extends Controller
{
    use UploadImageTrait;
    public function profile(Request $request, $id = 0){
        $data['countries'] = Country::all();
        $data['profile'] = User::findOrFail(Auth::user()->id);
        return view('admin.users.profile')->with($data);
    }

    public function save(ProfileRequest $request){

        $profile = User::findOrFail(Auth::user()->id);

        if ($request->hasFile('logo')) {
            $profile->profile_image = $this->UploadImage($request->file('logo'), 'logos/profiles/', $profile->profile_image);
        }
        
        $profile->title = $request->title;
        $profile->first_name = $request->first_name;
        $profile->last_name = $request->last_name;
        $profile->country_id = $request->country_id; 
        $profile->work = $request->work ?? '';
        $profile->user_name = $request->user_name;
        if($request->password && !empty($request->password)){
            $profile->password = Hash::make($request->password);
        }
        $profile->save();
        return redirect()->back()->with('success', 'Profile updated successfully.');   
    }

    public function listing(){
    	return view('admin.users.listing');
    }

    public function fetchList(){
    
    
        $user  = User::select(['id','title','first_name','last_name', 'email', 'user_name', 'created_at', 'is_active']);
        
		return datatables()->of($user)
	        ->editColumn('created_at', function($user){
	        	return $date = Carbon::parse($user->created_at)->isoFormat('Do MMM YYYY');
	        })
            ->addColumn('action', function($user){
                $buttons = '<div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">';
                            if($user->is_active == 1){
                                $buttons .= '<a class="dropdown-item btnStatus" href="#" data-id="'.$user->id.'" data-status="0"><i class="fas fa-times text-orange-red"></i>Disable</a>';
                            }else{
                                $buttons .= '<a class="dropdown-item btnStatus" href="#" data-id="'.$user->id.'" data-status="1"><i class="fas fa-cogs text-dark-pastel-green"></i>Enable</a>';
                            }
                $buttons .= '</div>
                        </div>';
                return $buttons;
            })
	        ->make(true);
    }

    public function changeStatus(Request $request){
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'User id is required.',
                'status' => 400
            ]);
        }else{
            $user = User::where('id', $request->id)->update(['is_active' => $request->status]);
            return response()->json([
                'message' => 'Status updated successfully.',
                'status' => 200
            ]);
        }
    }
}
