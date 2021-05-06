<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Publication;
use App\Models\Tile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search('*')->orderBy('published_at', 'desc');
        // $posts = $posts->paginate(4);
        $posts = $posts->take(4)->get();
        $featured_post = Post::inRandomOrder()->first();
        $publications = Publication::published()->orderBy('published_at','desc')->take(2)->get();
        $tiles = Tile::published()->orderBy('published_at', 'desc')->get();

        return view('home', compact('posts', 'featured_post', 'publications', 'tiles'));
    }
}
