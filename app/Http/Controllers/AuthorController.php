<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Rating;

class AuthorController extends Controller
{
    public function view($slug)
    {
        $author = Author::where('slug', $slug)->first();
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

        $pages = Page::where('status', 1)->where('author_id', $author->admin_user_id)->orderBy("created_at", 'DESC')->paginate(5);
        return view("template.author", ["author" => $author, 'pages' => $pages, 'countComments' => $countComments,
        'countRatings' => $countRatings, 'sumRatings' => $sumRatings]);
    }
}
