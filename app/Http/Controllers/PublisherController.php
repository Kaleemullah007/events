<?php

namespace App\Http\Controllers;
use App\Publisher;
use Carbon\Carbon;
use Datatables;
use Illuminate\Http\Request;
use App\Http\Requests\SavePublisherRequest;
use Validator;
use App\Http\Traits\UploadImageTrait;

class PublisherController extends Controller
{
    use UploadImageTrait;
	public function create(Request $request, $id = 0){

		$data = [];
        if(isset($id) && $id > 0){
        	$data['publisher'] = Publisher::findOrFail($id);
        }

    	return view('admin.publishers.create')->with($data);
    }

    public function save(SavePublisherRequest $request){

    	if(isset($request->id) && intval($request->id) > 0){
    		$publisher = Publisher::findOrFail($request->id);
    	}else{
    		$publisher = new Publisher();
    	}

    	if ($request->hasFile('logo')) {
            $publisher->logo = $this->UploadImage($request->file('logo'), 'logos/publishers/', $publisher->logo);
	    }
	    
	    $publisher->name = $request->name;
	    $publisher->is_active = 1;
	    $publisher->save();

		if(isset($request->id) && intval($request->id) > 0){
			return redirect()->back()->with('success', 'Publisher updated successfully.');   
		}else{
			return redirect('/admin/publishers/listing')->with('success', 'Publisher added successfully.');   
		}
    }

    public function listing(){
    	return view('admin.publishers.listing');
    }

    public function fetchList(){
    
        $publisher  = Publisher::select(['id','name','is_active', 'created_at', 'is_active']);
            		
		return datatables()->of($publisher)
	        ->editColumn('created_at', function($publisher){
	        	return $date = Carbon::parse($publisher->created_at)->isoFormat('Do MMM YYYY');
	        })
	        ->addColumn('action', function($publisher){
	            $buttons = '<div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item btnDelete" href="#" data-id="'.$publisher->id.'"><i class="fas fa-times text-orange-red"></i>Delete</a>
                                    <a class="dropdown-item" href="/admin/publishers/'.$publisher->id.'/edit"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>';
                                    if($publisher->is_active == 1){
                                        $buttons .= '<a class="dropdown-item btnStatus" href="#" data-id="'.$publisher->id.'" data-status="0"><i class="fas fa-times text-orange-red"></i>Disable</a>';
                                    }else{
                                        $buttons .= '<a class="dropdown-item btnStatus" href="#" data-id="'.$publisher->id.'" data-status="1"><i class="fas fa-cogs text-dark-pastel-green"></i>Enable</a>';
                                    }
                $buttons .= '</div>
                        </div>';
                return $buttons;
	        })
	        ->make(true);
    }

    public function delete(Request $request){
    	$validator = Validator::make($request->all(), [
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
			    'message' => 'Publisher id is required.',
			    'status' => 400
			]);
        }else{
        	$res = Publisher::where('id', $request->id)->delete();
        	return response()->json([
			    'message' => 'Publisher delted successfully.',
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
                'message' => 'Publisher id is required.',
                'status' => 400
            ]);
        }else{
            $user = Publisher::where('id', $request->id)->update(['is_active' => $request->status]);
            return response()->json([
                'message' => 'Status updated successfully.',
                'status' => 200
            ]);
        }
    }
}
