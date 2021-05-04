<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Publication;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search('*')->orderBy('published_at', 'desc');
        $posts = $posts->paginate(4);
        $featured_post = Post::inRandomOrder()->first();

        $publications = Publication::published()->orderBy('published_at','desc')->take(2)->get();

        return view('home', compact('posts', 'featured_post', 'publications'));
    }
}
