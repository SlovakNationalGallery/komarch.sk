<?php

use App\Http\Controllers\Api\ArchitectController;
use App\Http\Controllers\Api\ArchitectFiltersController;
use App\Http\Controllers\Api\ImportFromUrad;
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

Route::get('/posts', 'App\Http\Controllers\Api\PostController@index')->name('api.posts.index');;
Route::get('/posts-filters', 'App\Http\Controllers\Api\PostController@filters')->name('api.posts-filters.index');;
Route::get('/post/{id}/related', 'App\Http\Controllers\Api\PostController@related');

Route::get('/documents', 'App\Http\Controllers\Api\DocumentController@index');
Route::get('/documents-filters', 'App\Http\Controllers\Api\DocumentController@filters');
Route::get('/document/{id}/download', 'App\Http\Controllers\Api\DocumentController@download');

Route::get('/works', 'App\Http\Controllers\Api\WorkController@index')->name('api.works.index');
Route::get('/works-filters', 'App\Http\Controllers\Api\WorkController@filters')->name('api.works-filters.index');
Route::get('/works/{id}/images', 'App\Http\Controllers\Api\WorkController@images');

Route::get('/contests', 'App\Http\Controllers\Api\ContestController@index')->name('api.contests.index');
Route::get('/contests-filters', 'App\Http\Controllers\Api\ContestController@filters')->name('api.contests-filters.index');

