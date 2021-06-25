<?php

use App\Http\Controllers\Api\ArchitectController;
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

Route::get('/posts', 'App\Http\Controllers\Api\PostController@index');
Route::get('/posts-filters', 'App\Http\Controllers\Api\PostController@filters');
Route::get('/post/{id}/related', 'App\Http\Controllers\Api\PostController@related');

Route::get('/documents', 'App\Http\Controllers\Api\DocumentController@index');
Route::get('/documents-filters', 'App\Http\Controllers\Api\DocumentController@filters');
Route::get('/document/{id}/download', 'App\Http\Controllers\Api\DocumentController@download');

Route::get('/works', 'App\Http\Controllers\Api\WorkController@index');
Route::get('/works-filters', 'App\Http\Controllers\Api\WorkController@filters');
Route::get('/works/{id}/images', 'App\Http\Controllers\Api\WorkController@images');
