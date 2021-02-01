<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        // Note: Either this query param has to be named "query", ot the
        // paginator views need to be customized to generate links with a
        // different query param, e.g "search".
        $query = $request->input('query');

        $posts = null;
        if (empty($query)) {
            $posts = Post::published()->orderBy('published_at', 'desc')->paginate(10);
        } else {
            $posts = Post::search($query)->paginate(10);
        }

        return view('search.index', compact('posts', 'query'));
    }
}
