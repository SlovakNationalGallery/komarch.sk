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

    public function getDetail($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        if (empty($post)) {
            abort(404);
        }

        return view('post', array('post'=>$post));
    }

    public function show(Post $post)
    {
        $breadcrumbs = [
            'Domov' => route('home'),
            'Novinky o činnosti' => route('posts.index'),
            $post->title => null,
        ];

        return view('posts.show', compact('post', 'breadcrumbs'));
    }
}
