<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Author;

class AuthorController extends Controller
{
    public function view($slug)
    {
        $author = Author::where('slug', $slug)->first();
        $pages = Page::where('status', 1)->where('author_id', $author->admin_user_id)->orderBy("created_at", 'DESC')->paginate(5);
        return view("template.author", ["author" => $author, 'pages' => $pages]);
    }
}
