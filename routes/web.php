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

// Route::resource('user', 'UserController');
Route::resource('category', 'CategoryController');
Route::resource('product', 'ProductController');
Route::resource('order', 'OrderController');
Route::resource('cart', 'CartController');

Route::post('cart/add/{cart?}','CartController@addProduct')->name('cart.add');
Route::delete('cart/remove/{cartHasProducts}','CartController@removeProduct')->name('cart.remove.item');

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
