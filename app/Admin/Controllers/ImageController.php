<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Author;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        //$image = $request->file('upload'); // get file
        $image = Storage::disk('s3')->put('images/page', $request->file('upload'), 'public');
        // response
        $param = [
                'uploaded' => 1,
                'fileName' => env('AWS_URL').$image,
                'url' => env('AWS_URL').$image
        ];
        return response()->json($param, 200); 
    }
}
