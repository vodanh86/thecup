<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use Carbon\Carbon;
use App\Models\Comment;
use App\Models\Rating;

class CategoryController extends Controller
{
    //
    public function index()
    {
        return view('welcome', []);
    }

    public function view($slug)
    {
        $cat = Category::where('slug', $slug)->first();
        $sortField = "created_at";
        if(array_key_exists('sort',$_GET)){
            $sort = $_GET['sort'];
            if($sort == "author"){
                $sortField = "created_at";
            }
        }
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

        $pages = Page::where('status', 1)->where('category_id', $cat->id)->orderBy($sortField, 'DESC')->paginate(5);
        return view('template.category', ["cat" => $cat, "pages" => $pages, 'countComments' => $countComments,
        'countRatings' => $countRatings, 'sumRatings' => $sumRatings, "title" => $cat->title]);
    }

    public function podcasts()
    {
        $sortField = "created_at";

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

        if(array_key_exists('sort',$_GET)){
            $sort = $_GET['sort'];
            if($sort == "author"){
                $sortField = "created_at";
            }
        }

        $pages = Page::where('status', 1)->where('type', 2)->orderBy($sortField, 'DESC')->paginate(5);
        return view('template.category', ["pages" => $pages, 'countComments' => $countComments,
        'countRatings' => $countRatings, 'sumRatings' => $sumRatings, "title" => "Podcast"]);
    }
}
