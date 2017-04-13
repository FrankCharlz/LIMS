<?php

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

Route::get('/', function () {
    return view('home');
});

Route::get('/demo', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


Route::get('/plots/add/{lat}/{lng}', 'PlotsController@add');
Route::get('/plots/view/{id}', 'PlotsController@view');
Route::get('api/plots', 'PlotsController@all');


Route::post('/plots/new', 'PlotsController@new_plot');

\
//applications
Route::get('/applications/user/{uid}', 'ApplicationController@listForUser');
Route::get('/applications/all', 'ApplicationController@listAll');
Route::get('/applications/add', 'ApplicationController@create_view');

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