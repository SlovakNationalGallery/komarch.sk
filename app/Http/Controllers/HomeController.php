<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search('*')->orderBy('published_at', 'desc');
        $posts = $posts->paginate(4);
        $featured_post = Post::inRandomOrder()->first();

        $tiles = Tile::published()->orderBy('published_at', 'desc')->get();

        return view('home', compact('posts', 'featured_post', 'tiles'));
    }
}
