<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search('*')->orderBy('published_at', 'desc');
        $posts = $posts->paginate(4);
        $featured_post = Post::inRandomOrder()->first();

        return view('home', compact('posts', 'featured_post'));
    }
}
