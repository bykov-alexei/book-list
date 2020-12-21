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

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function () {
        return redirect('home');
    });
    Route::get('/home', 'HomeController@index')->name('home');
    
    Route::get('/book', 'BookController@index');
    Route::get('/book/all', 'BookController@all');
    Route::get('/book/{book}', 'BookController@show');
    
    Route::post('/book', 'BookController@store'); 
    Route::delete('/book/{book}', 'BookController@destroy');
    
    Route::post('/book/{book}/read', 'BookController@start_reading');
    Route::delete('/book/{book}/read', 'BookController@exclude'); 
    Route::put('/book/{book}/read', 'BookController@return_back'); 
    Route::post('/book/{book}/finish', 'BookController@end_reading'); 
    Route::delete('/book/{book}/finish', 'BookController@pause_reading');

});