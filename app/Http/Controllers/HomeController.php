<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Mews\Captcha\Facades\Captcha;
use Illuminate\Http\Request;
use App\Admin\Controllers\Util;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Rating;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $topPages = Page::where('status', 1)->orderBy('feature', 'DESC')->orderBy("created_at", 'DESC')->limit(4)->get();
        $banner = Banner::where('show', 1)->where('position', 1)->first();
        $newComments = Comment::where('verify', 1)->orderBy("id", "DESC")->limit(5)->get();
        $ids = array();
        foreach($topPages as $page){
            $ids[] = $page->id;
        }
        $cats = Category::all()->pluck('title','id')->toArray();
        $pages = Page::where('status', 1)->whereNotIn('id', $ids)->orderBy("created_at", 'DESC')->paginate(5);
        $podcast = Page::where('type', 2)->orderBy("view", 'DESC')->first();
        $countComments = Comment::where('verify', 1)
        ->selectRaw('page_id, count(*) as total')
        ->groupBy('page_id')
        ->pluck('total','page_id')->all();
        $countRatings = Rating::selectRaw('page_id, count(*) as total')
        ->groupBy('page_id')
        ->pluck('total','page_id')->all();
        $sumRatings = Rating::selectRaw('page_id, sum(rate) as total')
        ->groupBy('page_id')
        ->pluck('total','page_id')->all();


        return view('welcome', ["pages" => $pages, 'topPages' => $topPages, "newComments" => $newComments,
        'countComments' => $countComments, 'banner' => $banner, "cats" => $cats, "podcast" => $podcast,
        'countRatings' => $countRatings, 'sumRatings' => $sumRatings]);
    }

    public function forgot(){
        $rules = ['captcha' => 'required|captcha'];
        $validator = validator()->make(request()->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'message' => "Captcha kh??ng ch??nh x??c",
                'data' => Captcha::img()
            ]);
        } else {
            $email = $_REQUEST["email"];
            $user = User::where("email", $email)->first();
            if (is_null($user)){
                return response()->json([
                    'status' => 0,
                    'message' => "Email kh??ng t???n t???i",
                    'data' => Captcha::img()
                ]);
            } else {
                $password = Util::randomPassword();
                $user->password = Hash::make($password);
                $user->save();

                Mail::raw('M???t kh???u m???i c???a b???n l??: '.$password, function($msg) use(&$email) { 
                    $msg->to($email)->subject('Reset m???t kh???u'); });
                return response()->json([
                    'status' => 1,
                    'message' => "???? reset m???t kh???u, vui l??ng ki???m tra email",
                    'data' => Captcha::img()
                ]);
            }
        }
    }
}
