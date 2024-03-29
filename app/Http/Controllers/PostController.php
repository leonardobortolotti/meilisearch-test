<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'slug' => Str::slug($request->title , '-') . '-' . time(),
            'content' => $request->content,
            'published' => $request->published,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'data' => $post,
            'status' => 200,
        ]);
    }
}
