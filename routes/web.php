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

Route::get('testmail',function(){
    Mail::send('emails.test',[
        'test1'=>'Eloquent'
    ],function($m){
        $m->from('orders@rockcode.net', 'Diogo');
        $m->to('orders@rockcode.net');
    });

    return view('emails.order-shipped');
});

Route::resource('category', 'CategoryController')->middleware('auth');
Route::resource('product', 'ProductController')->middleware('auth');
Route::resource('order', 'OrderController')->middleware('auth');
Route::resource('cart', 'CartController')->middleware('auth');

Route::post('cart/add/{cart}','CartController@addProduct')->name('cart.add')->middleware('auth');
Route::delete('cart/remove/{cartHasProducts}','CartController@removeProduct')->name('cart.remove.item')->middleware('auth');

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
