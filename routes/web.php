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
Route::get('/unggah', 'HomeController@showUnggah')->name('unggah');
Route::get('/soal', 'HomeController@showSoal')->name('soal');
Route::get('/unduhsoal/{path}', 'HomeController@downloadSoal')->name('unduh-soal');
Route::post('/unggah', 'HomeController@postUnggah')->name('post-unggah');
Route::get('/profile/password', 'HomeController@getChangePass')->name('get-change-pass');
Route::post('/profile/password', 'HomeController@changePass')->name('change-pass');

// Route::get('/popup', 'HomeController@popup')->name('popup');
Route::get('/resetuser', function(){
    foreach(\App\User::all() as $data){
        if($data['is_admin'] != 1){
            \App\User::where('id', $data['id'])->update(['is_admin'=>'0']);
        }
    }
    return "Oke";
});

Route::get('voice', function(){
    return view('admin.voice');
});

Route::prefix('ngadmin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/', 'AdminController@dash');
        Route::get('config', 'AdminController@config');        
        Route::get('addstudent', 'AdminController@addStudent');
        Route::post('addstudent', 'AdminController@import')->name('import-student');
        Route::post('setstudent', 'AdminController@setStudent')->name('set-student');
        Route::post('resettest', 'AdminController@resetTest')->name('reset-test');
    });
});