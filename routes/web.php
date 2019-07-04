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

//public route
Route::group(['namespace'=>'Frontend'],function(){
    Route::get('/','HomeController@showHomePage')->name('frontend.home');

    //products
    Route::get('/product/{slug}','ProductController@showDetails')->name('product.details');

    //cart
    Route::get('/cart','CartController@showCart')->name('cart.show');
    Route::post('/cart','CartController@addToCart')->name('cart.add');
    Route::post('/cart/remove','CartController@removeToCart')->name('cart.remove');
    Route::get('/cart/clear','CartController@clearCart')->name('cart.clear');

    //route checkout
    Route::get('/checkout','CartController@checkout')->name('checkout');

    //Register Login
    Route::get('/login','AuthController@showLoginForm')->name('login');
    Route::post('/login','AuthController@processLogin');

    Route::get('/register','AuthController@showRegisterForm')->name('register');
    Route::post('/register','AuthController@processRegister');

    //activate  email
  Route::get('/activate/{token}','AuthController@mail_activate')->name('activate');

  //activate route
    Route::group(['middleware'=>'auth'],function(){

        Route::post('/order','CartController@order')->name('order');

        Route::get('/profile','AuthController@profile')->name('profile');
        Route::get('/logout','AuthController@logout')->name('logout');
    });
});
