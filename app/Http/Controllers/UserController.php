<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class UserController extends Controller
{
    // Page login
    public function login()
    {
        return view('user.login');
    }

    //validate user
    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'esri_id' => 'required'
        ]);

        $validator->validate();

        if (!isset($request->esri_id)) {
            return redirect()->back()->with('error', 'Profile does not exist in our system');
        }

        $userEmail = strtolower($request->esri_id);

        try {
            $userValidate = User::where('email', $userEmail)->firstOrFail();
        } catch (ModelNotFoundException $exception) {
            return redirect()->back()->with('error', 'Profile does not exist in our system');
        }

        if ($userValidate->attendance == 1) {
            if ($userValidate->voting_number == 2) {
                return redirect()->back()->with('error', 'You have used your votes. Thank you and enjoy the townhall.');
            } else {
                return redirect()->route('vote.male',['user_id'=>$userValidate->id]);
            }
        }else{
            return redirect()->route('user.update_image', ['name' => $userValidate->name]);
        }

    }



    // update_image_page
    // need to check either the image is available or not.
    public function update_image($name)
    {
        $validateImage = User::where('name', $name)->whereNull('img_path')->exists();

        return view('user.uploadImage', [
            'name' => $name,
            'validate_profile_img' => $validateImage
        ]);
    }


    public function update_image_service(Request $request)
    {
        $imageData = $request->input('image');
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);
        $imageBinaryData = base64_decode($imageData);

        $filename = uniqid() . '.jpg';
        $path = 'public/' . $filename;

        // Convert the binary image data to a file
        $image = Image::make($imageBinaryData);
        $image->rotate(90);
        Storage::put($path, (string) $image->encode());

        // Get the URL or path to the uploaded file
        $url = Storage::url($path);
        $path = Storage::path($path);

        $user = User::where('name', $request->username)->first();
        $user->img_path = $url;
        if ($user->attendance === 0) {
            $user->attendance = 1;
        }
        $user->save();

        return redirect()->route('user.login');
    }
}
