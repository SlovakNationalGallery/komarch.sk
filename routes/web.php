<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/styleguide', function () {
    return view('styleguide');
})->name('styleguide');

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{

    Route::get('/', 'App\Http\Controllers\HomeController@index')->name('home');

    Route::get('/dokumenty', 'App\Http\Controllers\DocumentsController@index')->name('documents');

    Route::get('/diela', 'App\Http\Controllers\WorksController@index')->name('works');
    Route::get('/dielo/{id}-{slug}', 'App\Http\Controllers\WorksController@show')->name('works.detail');

    Route::get('/search', 'App\Http\Controllers\SearchController@index')->name('search');

    Route::resource('spravy', '\App\Http\Controllers\PostsController')->names('posts')
                ->parameter('spravy', 'post');

    Route::get('/sutaze', 'App\Http\Controllers\ContestsController@index')->name('contests');
    Route::get('/sutaz/{id}-{slug}', 'App\Http\Controllers\ContestsController@show')->name('contests.detail');


    Route::get('{slug}', 'App\Http\Controllers\PagesController@show');
});
