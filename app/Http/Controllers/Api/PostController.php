<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = $this->loadPosts($request);

        // quick search
        if ($request->filled('q')) {
            $posts->whereIn('id', Post::search("*{$request->query('q')}*")->keys());
        }

        // fulltext search
        if ($request->filled('search')) {
            $posts->whereIn('id', Post::search($request->query('search'))->keys());
        }

        // sort
        $posts->orderBy('is_featured', 'desc')->orderBy(
            $request->input('sortby', 'published_at'),
            $request->input('direction', 'desc')
        );

        $per_page = (int) min($request->get('per_page', 6), 15);
        return PostResource::collection($posts->paginate($per_page));
    }

    public function filters()
    {
        $categories = Tag::query()
            ->has('posts')
            ->select('name')
            ->withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get()
            ->pluck('posts_count', 'name');

        return ['categories' => $categories];
    }

    public function show(Post $post)
    {
        $related_posts = Post::boolSearch($post->id)
            ->must(
                'more_like_this',
                [
                    'fields' => ['title.' . app()->getLocale()],
                    'like' => [
                        '_id' => $post->id
                    ],
                    'min_term_freq' => 1,
                    'min_doc_freq' => 1,
                ])
            ->size(10)
            ->execute();

        return [
            'id' => $post->id,
            'related' => PostResource::collection($related_posts->models()),
        ];
    }

    private function loadPosts(Request $request)
    {
        $posts = Post::published()->with('media');

        // apply filters
        if ($request->has('categories')) {
            $posts->withAnyTags($request->input('categories', []));
        }

        return $posts;
    }
}
