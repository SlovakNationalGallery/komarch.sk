<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Post;
use App\Http\Resources\PostResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/posts', function (Request $request) {
    $posts = Post::published()->orderBy('published_at', 'desc');
    if ($request->has('categories')) {
        $posts->withAnyTags($request->input('categories', []));
    }
    if ($request->has('featured')) {
        $posts->featured();
    }
    return PostResource::collection($posts->paginate());
});

Route::get('/related-posts', function (Request $request) {
    $related = Post::take(10)->inRandomOrder()->get();
    return PostResource::collection($related);
});
