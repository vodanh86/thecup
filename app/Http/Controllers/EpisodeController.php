<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Page;
use App\Models\Photo;
use App\Models\Song;
use App\Models\AuthUser;
use Carbon\Carbon;

class EpisodeController extends Controller
{
    //
    public function index()
    {
        return view('welcome', []);
    }

    public function view($slug)
    {
        $song = Song::where('slug', $slug)->first();
        $podcast = Page::find($song->podcast_id);
        $cat = Category::find($podcast->category_id);
        /*$author = AuthUser::find($page->author_id);
        $photos = Photo::where("album_id", $page->id)->get();
        $songs = Song::where("podcast_id", $page->id)->get();

        $view = 'template.covid_post';
        if ($page->type == 1){
            $view = 'template.image_post';
        }
        if ($page->type == 2){
            $view = 'template.podcast_episodes';
        }*/
        return view("template.podcast_single", ["song" => $song, "podcast" => $podcast,
        "cat" => $cat]);
    }
}
