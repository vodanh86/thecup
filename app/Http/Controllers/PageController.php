<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Song;
use App\Models\Author;
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
        $author = Author::where("admin_user_id", $page->author_id)->first();
        $photos = Photo::where("album_id", $page->id)->get();
        $songs = Song::where("podcast_id", $page->id)->get();

        $view = 'template.covid_post';
        if ($page->type == 1){
            $view = 'template.image_post';
        }
        if ($page->type == 2){
            $view = 'template.podcast_episodes';
        }
        return view($view, ["page" => $page, "photos" => $photos, "songs" => $songs,
        "cat" => $cat, "author" => $author]);
    }

    public function contact()
    {
        return view('template.contact', []);
    }
}
