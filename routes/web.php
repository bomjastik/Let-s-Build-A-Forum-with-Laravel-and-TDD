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

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::resource('threads', 'ThreadController', ['only' => ['create', 'store']]);

    Route::resource('threads.replies', 'ReplyController', ['only' => ['store']]);
});

Route::get('threads/{channel?}', 'ThreadController@index')->name('threads.index');
Route::get('threads/{channel}/{thread}', 'ThreadController@show')->name('threads.show');

Auth::routes();
