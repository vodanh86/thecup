<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Models\Plan;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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


    public function profile()
    {
        $orders = Order::where("user_id", \Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view('template.my_account', ["orders" => $orders]);
    }

    public function purchase()
    {
        $plans = Plan::all();
        return view('template.purchase', ["plans" => $plans]);
    }

    public function subscribe(Request $request)
    {
        $plan = Plan::find($request->plan);
        $order = new Order();
        $order->user_id =  \Auth::user()->id;
        $order->plan_id = $request->plan;
        $order->price = $plan->price;
        $order->order_code = date("YmdHis").\Auth::user()->id.$request->plan;
        $order->save();
        return view('subscribe', ["plan" => $plan, "order" => $order]);
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
        $user->birthdate = date("Y-m-d", strtotime($request->birthdate));
        if ($request->password != '******'){
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
