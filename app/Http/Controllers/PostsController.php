<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function show(Post $post)
    {
        return $post->title; //view('posts.show', compact('post'));
    }
}
