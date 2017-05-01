<?php

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

Route::get('/plots/view/{id}', 'PlotsController@view');
Route::get('/plots/all', 'PlotsController@all');


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


