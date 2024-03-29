<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('user', 'UserCrudController');
    Route::crud('post', 'PostCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('page', 'PageCrudController');
    Route::crud('document', 'DocumentCrudController');
    Route::crud('publication', 'PublicationCrudController');
    Route::crud('tile', 'TileCrudController');
    Route::crud('work', 'WorkCrudController');
    Route::crud('award', 'AwardCrudController');
    Route::crud('contest', 'ContestCrudController');
    Route::crud('video', 'VideoCrudController');
    Route::crud('deadline', 'DeadlineCrudController');
}); // this should be the absolute last line of this file