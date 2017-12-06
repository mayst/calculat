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

use Illuminate\Support\Facades\Auth;
use App\Message;
use App\User;
use App\Info;

Route::get('/', function () {
    $womans = Info::where('male', 'woman')->inRandomOrder()->limit(8)->get();

    return view('welcome', [
        'womans' => $womans
    ]);
});

Auth::routes();

Route::post('ulogin', 'UloginController@login');

Route::post('send_contact', 'HomeController@sendContact');

Route::get('profile/{id}', 'UserController@showProfile')->name('profile');

Route::get('blog', 'BlogController@viewPosts')->name('blog');

Route::get('article/{name}', 'BlogController@viewArticle');

Route::post('sent', 'HomeController@sent')->name('sent');

Route::get('search', function() {
    if(Auth::check()) {
        $user = Auth::user();

        $q1 = DB::table('messages')->select('receiver AS id')->where('user_id', $user->id)->groupBy('id');
        $q2 = DB::table('messages')->select('user_id AS id')->where('receiver', $user->id)->union($q1)->groupBy('id')->get();

        $list_dialogs = [];
        foreach($q2 as $dialog) {
            $list_dialogs[] = Message::where([
                ['user_id', '=', $user->id],
                ['receiver', '=', $dialog->id]
            ])->orWhere([
                ['user_id', '=', $dialog->id],
                ['receiver', '=', $user->id]
            ])->orderBy('created_at', 'desc')->first();
        }
    } else {
        $list_dialogs = null;
    }

    return view('search', [
        'list_dialogs' => $list_dialogs
    ]);
})->name('search');

Route::post('/find/byName', 'UserController@findByName');

Route::post('/find/byOther', 'UserController@findByOther');

Route::post('/ajax/qfind', 'UserController@quickFind');

Route::group(['prefix' => 'ws'], function () {

    Route::get('check-auth', function () {
        return response()->json([
            'auth' => Auth::check()
        ]);
    });

    Route::get('check-sub/{channel}', function ($channel) {
        $user = User::find($channel);
        $status = $user->status;
        $status->online = true;
        $status->save();

        return response()->json([
            'can' => Auth::user()->id == $channel
        ]);
    });

    Route::get('disconnect/{channel}', function ($channel) {
        $user = User::find($channel);
        $status = $user->status;
        $status->online = false;
        $status->save();

        return response()->json([$user->name]);
    });
});

Route::group(['middleware' => ['auth', 'ban']], function () {

    Route::post('save_profile/{id}', 'UserController@updateProfile');

    Route::post('upload_gallery', 'UserController@uploadGallery');

    Route::post('delete_gallery/{photo}', 'UserController@deleteGallery');

    Route::post('ajax/dialogs', 'ChatsController@listDialogs');

    Route::post('ajax/find', 'UserController@findWord')->name('ajax_find');

    Route::post('ajax/favorite', 'UserController@addFavorite');

    Route::get('socket', 'ChatsController@index');

    Route::post('change_avatar', 'UserController@changeAvatar');

    Route::post('history', 'ChatsController@history');

    Route::post('message', 'ChatsController@SENDm');

    Route::get('favorites', 'UserController@showFavorites');

    Route::get('settings', function () {
        return view('profile-settings');
    });
});

Route::get('/{name}', 'PageController@viewPage');