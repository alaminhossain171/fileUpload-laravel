<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/',function(){
    return view('HompPage');
});
Route::post('/fileUp','uploadController@fileUpload');

Route::get('/download/{folderPath}/{name}','downlodController@onDownload');
Route::get('/select','uploadController@onSelect');
