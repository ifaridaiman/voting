<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Page login
    public function login(){
        return view('user.login');
    }

    //validate user
    public function validation(Request $request){

        $validator = Validator::make($request->all(),[
            'esri_id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator);
        }

        $userValidate = User::where('esri_id', $request->esri_id)->firstOrFail();

        if(is_null($userValidate)){
            return redirect()
                ->back()
                ->withErrors('No User Exists');
        }else{
            return redirect()->route('user.update_image',['name' => $userValidate->name]);
        }
    }



    // update_image_page
    // need to check either the image is available or not.
    public function update_image($name){
        $validateImage = User::where('name',$name)->whereNull('img_path')->exists();

        return view('user.uploadImage',[
            'name' => $name,
            'validate_profile_img' => $validateImage
        ]);
    }


    public function update_image_service(Request $request){

    }
}
