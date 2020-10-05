<?php

use Illuminate\Support\Facades\Mail;
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

// Route::resource('user', 'UserController');


Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');
Route::resource('order', 'OrderController');
Route::resource('cart', 'CartController');

Route::get('user', 'UserController@index')->name('user.index');
Route::get('user/create', 'UserController@create')->name('user.create');
Route::post('user', 'UserController@store')->name('user.store');
Route::get('user/{user}', 'UserController@show')->name('user.show');
Route::get('user/{user}/edit', 'UserController@edit')->name('user.edit');
Route::put('user/{user}', 'UserController@update')->name('user.update');
Route::delete('user/{user}', 'UserController@destroy')->name('user.destroy');

Route::post('cart/add/{cart}','CartController@addProduct')->name('cart.add');
Route::delete('cart/remove/{cartHasProducts}','CartController@removeProduct')->name('cart.remove.item');

Route::get('logger/{user?}','LoggerController@index')->name('logger.index');

Route::get('/', function () {
    return view('index');
})->name('init');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
