<?php

namespace App\Http\Traits;

trait UploadImageTrait {
    public function UploadImage($image, $destinationPath, $oldImage='') {
        //$image = $request->file('logo');
        if(isset($oldImage) && !empty($oldImage)){
        	if(\File::exists(public_path($destinationPath.$oldImage))){
			  	\File::delete(public_path($destinationPath.$oldImage));
			}
        }
        
	    $logoName = time().'.'.$image->getClientOriginalExtension();
	    $destinationPath = public_path($destinationPath);
	    $image->move($destinationPath, $logoName);
	    return $logoName;
    }
}