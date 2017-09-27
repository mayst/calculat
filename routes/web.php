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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('profile/{id}', 'UserController@showProfile')->name('profile');

Route::get('/blog', 'BlogController@viewPosts')->name('blog');

Route::get('/search', function() {
    return view('search');
})->name('search');

Route::post('/find/byName', 'UserController@findByName');

Route::post('/find/byOther', 'UserController@findByOther');

Route::group(['middleware' => ['auth']], function () {
    //
    Route::post('save_profile/{id}', 'UserController@updateProfile');

    Route::post('/ajax/find', 'UserController@findWord')->name('ajax_find');

    Route::get('chat', 'ChatsController@fetchMessages');

    Route::post('messages', 'ChatsController@sendMessage');
});

Route::get('/{name}', 'PageController@viewPage');