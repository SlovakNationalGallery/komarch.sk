<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $posts = null;
        if (empty($search)) {
            $posts = Post::published()->orderBy('published_at', 'desc')->paginate(10);
        } else {
            $posts = Post::search($search)->paginate(10);
        }

        return view('posts.index', compact('posts'));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
