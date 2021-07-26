<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use Carbon\Carbon;

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
            $pages = Page::where('status', 1)->where('category_id', $cat->id)->orderBy($sortField, 'DESC')->paginate(3);
            return view('template.economy', ["cat" => $cat, "pages" => $pages, "sort" => $sort]);
        }
        $pages = Page::where('status', 1)->where('category_id', $cat->id)->orderBy($sortField, 'DESC')->paginate(3);
        return view('template.economy', ["cat" => $cat, "pages" => $pages]);
    }
}
