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
    return redirect('threads');
});

Route::get('threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');
Route::resource('threads', 'ThreadController', ['except' => 'show']);

Route::resource('threads.replies', 'ReplyController', ['only' => ['store']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
