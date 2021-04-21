<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// models
use App\Models\Post;

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
    $posts = Post::orderBy('published_at', 'desc');
    if ($request->has('categories')) {
        $posts->withAnyTags($request->input('categories', []));
    }
    if ($request->has('featured')) {
        $posts->featured();
    }
    return $posts->limit(3)->get();
});