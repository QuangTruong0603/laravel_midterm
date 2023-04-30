<?php

use App\Http\Controllers\HomeController;
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
Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@checkUserType');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/data', 'HomeController@data')->name('data');
Route::get('/history', 'HomeController@history')->name('history');
Route::get('/statistics', 'HomeController@statistic')->name('statistics');

Route::post('/home', 'HomeController@addSleep')->name('addSleep');
Route::match(['put', 'patch'], '/home', 'HomeController@editSleep')->name('editSleep');
Route::match(['delete'], '/home', 'HomeController@removeSleep')->name('removeSleep');

Route::get('/adminHome', 'AdminController@adminHome')->name('adminHome');
Route::post('/adminHome', 'AdminController@addUser')->name('addUser');
Route::match(['put', 'patch'], '/adminHome', 'AdminController@editUser')->name('editUser');
Route::match(['delete'], '/adminHome', 'AdminController@removeUser')->name('removeUser');