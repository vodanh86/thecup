<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\AuthUser;
use Carbon\Carbon;

class PageController extends Controller
{
    //
    public function index()
    {
        return view('welcome', []);
    }

    public function view($slug)
    {
        $page = Page::where('slug', $slug)->first();
        $cat = Category::find($page->category_id);
        $author = AuthUser::find($page->author_id);
        $view = 'template.covid_post';
        if ($page->type == 1){
            $view = 'template.image_post';
        }
        return view($view, ["page" => $page, "cat" => $cat, "author" => $author]);
    }
}
