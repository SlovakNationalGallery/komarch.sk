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
            $posts = Post::orderBy('published_at', 'desc');
            if ($request->has('categories')) {
                $posts->withAnyTags($request->input('categories', []));
            }
        } else {
            $posts = Post::search($search);
        }

        $posts = $posts->paginate(10);

        return view('posts.index', compact('posts'));
    }



    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }
}
