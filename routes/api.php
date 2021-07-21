<?php

use App\Http\Controllers\Api\ArchitectController;
use App\Http\Controllers\Api\ArchitectFiltersController;
use App\Http\Controllers\Api\ImportFromUrad;
use App\Http\Resources\MediaResource;
use App\Models\Work;
use App\Http\Controllers\Api\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/jobs/import-from-urad', ImportFromUrad::class);

Route::get('architects', [ArchitectController::class, 'index'])->name('api.architects.index');
Route::get('architects-filters', [ArchitectFiltersController::class, 'index'])->name('api.architects-filters.index');

Route::resource('/posts', PostController::class)->names('api.posts')->parameters(['posts' => 'post:id']);
Route::get('/posts-filters', 'App\Http\Controllers\Api\PostController@filters')->name('api.posts-filters.index');;

Route::get('/documents', 'App\Http\Controllers\Api\DocumentController@index');
Route::get('/documents-filters', 'App\Http\Controllers\Api\DocumentController@filters');
Route::get('/document/{id}/download', 'App\Http\Controllers\Api\DocumentController@download');

Route::get('/works', 'App\Http\Controllers\Api\WorkController@index')->name('api.works.index');
Route::get('/works-filters', 'App\Http\Controllers\Api\WorkController@filters')->name('api.works-filters.index');
Route::get('/works/{work}/images', fn (Work $work) => MediaResource::collection($work->media));

Route::get('/contests', 'App\Http\Controllers\Api\ContestController@index')->name('api.contests.index');
Route::get('/contests-filters', 'App\Http\Controllers\Api\ContestController@filters')->name('api.contests-filters.index');

