<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Page;
use App\Models\Banner;
use Carbon\Carbon;

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
        $ids = array();
        foreach($topPages as $page){
            $ids[] = $page->id;
        }
        $cats = Category::all()->pluck('title','id')->toArray();
        $pages = Page::where('status', 1)->whereNotIn('id', $ids)->orderBy("created_at", 'DESC')->paginate(5);
        return view('welcome', ["pages" => $pages, 'topPages' => $topPages, 
        'banner' => $banner, "cats" => $cats]);
    }
}
