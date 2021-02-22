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

    Route::resource('spravy', '\App\Http\Controllers\PostsController')->names('posts')
                ->parameter('spravy', 'post');

    Route::get('{slug}', 'App\Http\Controllers\PagesController@show');
});
