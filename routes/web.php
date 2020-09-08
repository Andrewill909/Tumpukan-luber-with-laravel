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
    return view('frontweb');
});

//PERTANYAAN
Route::resource('pertanyaan', 'PertanyaanController');

Route::get('/pertanyaan/{id}/upvote','PertanyaanController@upvote')->name('pertanyaan.upvote');

Route::get('/pertanyaan/{id}/downvote','PertanyaanController@downvote')->name('pertanyaan.downvote');
 
//JAWABAN
route::get('/jawaban/create/{id_pertanyaan}','JawabanController@create')->name('jawaban.create');

route::post('/jawaban/store','JawabanController@store')->name('jawaban.store');

route::get('/jawaban/{jawaban_id}/edit','JawabanController@edit')->name('jawaban.edit');

route::put('/jawaban/{jawaban_id}','JawabanController@update')->name('jawaban.update');

Route::delete('/jawaban/{jawaban_id}','JawabanController@destroy')->name('jawaban.destroy');

Route::get('/jawaban/{jawaban_id}/jawaban_terbaik','JawabanController@terbaik')->name('jawaban.terbaik');

route::get('/jawaban/{id}/upvote','JawabanController@upvote')->name('jawaban.upvote');

route::get('/jawaban/{id}/downvote','JawabanController@downvote')->name('jawaban.downvote');


//AUTHENTIFICATION
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
