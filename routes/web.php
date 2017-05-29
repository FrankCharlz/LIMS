<?php

use App\Plot;

Route::get('/', function () {
    return view('home');
});

Route::get('/landing', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('/plots', 'PlotsController@plotsForUser')->middleware('auth');
Route::get('/plots/on-sale', 'PlotsController@listOnSale');
Route::get('/plots/add/{lat}/{lng}', 'PlotsController@add')->middleware('auth');
Route::post('/plots/new', 'PlotsController@new_plot')->middleware('auth');
Route::get('/plots/buy/{id}', 'PlotsController@buy')->middleware('auth');
Route::get('/plots/{id}/edit', 'PlotsController@edit')->middleware('auth');

Route::get('/plots/view/{id}', 'PlotsController@view');
Route::get('/plots/all', 'PlotsController@all');


Route::get('/search', 'SearchController@index');
Route::get('/search/r', 'SearchController@search');


//applications
Route::get('/applications', 'ApplicationController@listForUser');
Route::get('/applications/all', 'ApplicationController@listAll');
Route::get('/applications/create/{pid}', 'ApplicationController@create');
Route::get('/applications/cancel/{id}', 'ApplicationController@cancel');

//announcements
Route::get('/announcements', 'AnnouncementController@index');


Route::get('/outis/images/{filename}', function ($filename) {

    //filename = /images/....png
    $path = storage_path('app/images/' . $filename);

    //dd($path);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::get('/qq', function() {
$plots = Plot::where('plot_number', 'LIKE', '%b%')->get();
return $plots;
});

/***
 *  code for android
 */

Route::post('/login/app', 'AppController@loginApp');
Route::get('/app/user/{id}/plots', 'AppController@plots');
Route::get('/app/plots/on-sale', 'AppController@plotsOnSale');
Route::get('/app/announcements', 'AppController@announcements');
Route::get('/app/user/{id}/applications', 'AppController@applications');