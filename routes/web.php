<?php

use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Request;

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
Route::get('/searchs', function () {
    return view('searchs');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::any('/search',function(){
    $q = Request::input( 'q' );
    $user = User::where('name','LIKE','%'.$q.'%')->orWhere('email','LIKE','%'.$q.'%')->get();
    if(count($user) > 0)
        return view('searchs')->withDetails($user)->withQuery ( $q );
    else return view ('searchs')->withMessage('No Details found. Try to search again !');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/users', 'FollowController@index');
    Route::post('/follow/{user}', 'FollowController@follow');
    Route::delete('/unfollow/{user}', 'FollowController@unfollow');
    Route::delete('/comment/{comment}', 'CommentController@destroy');
    Route::resource('posts', 'PostsController');
    Route::get('global', 'PostsController@global');
    Route::get('data', 'PostsController@data');
    Route::post('/comment/store', 'CommentController@store')->name('comment.add');
    Route::get('/comment', 'CommentController@index');
    Route::get('profile', 'UserController@profile');
    Route::get('profile/{id}', ['as' => 'users.profile', 'uses' => 'UserController@profileview']);
    Route::post('profile', 'UserController@update_avatar');
    Route::get('users/{user}',  ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    Route::patch('users/{user}/update',  ['as' => 'users.update', 'uses' => 'UserController@update']);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
