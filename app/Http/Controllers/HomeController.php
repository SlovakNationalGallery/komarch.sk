<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::search('*');
        $posts = $posts->paginate(10);
        return view('home', compact('posts'));
    }
}
