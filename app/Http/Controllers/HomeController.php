<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Category;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Comment;
use App\Models\Rating;
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
        $comments = Comment::where('verify', 1)->orderBy("id", "DESC")->limit(5)->get();
        $ids = array();
        foreach($topPages as $page){
            $ids[] = $page->id;
        }
        $cats = Category::all()->pluck('title','id')->toArray();
        $pages = Page::where('status', 1)->whereNotIn('id', $ids)->orderBy("created_at", 'DESC')->paginate(5);
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


        return view('welcome', ["pages" => $pages, 'topPages' => $topPages, "comments" => $comments,
        'countComments' => $countComments, 'banner' => $banner, "cats" => $cats,
        'countRatings' => $countRatings, 'sumRatings' => $sumRatings]);
    }
}
