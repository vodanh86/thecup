<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:22'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    //
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:22'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = \Auth::user();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->avatar = $request->avatar;
        if ($request->password != '*******'){
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return response()->json([
            'user' => $user
        ]);
    }

    public function updateAvatar(Request $request)
    {
        if ($files = $request->file('avatar')) {
             
            //store file into document folder
            //$file = $request->avatar->store('public/avatar');
            $file = Storage::disk('s3')->put('images/avatar', $request->avatar, 'public');
 
            //store your file into database
            //$document = new Document();
            //$document->title = $file;
            //$document->save();
              
            return Response()->json([
                "success" => true,
                "file" => env('AWS_URL').$file,
                "path" => $file
            ]);
  
        }
  
        return Response()->json([
                "success" => false,
                "file" => ''
          ]);
    }

}
