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
    return redirect()->route('dashboard.index');
});

Auth::routes(['register' => false]);


// site routes

Route::group(['namespace' => 'Site'], function () {

    Route::get('', 'HomeController@index')->name('site.home.index');

    // cart routes
    Route::group(['prefix' => 'cart'], function () {

        //cart
        Route::get('', 'CartController@getCartContent')->name('site.cart.getCartContent');

        // add to cart
        Route::get('add-to-cart', 'CartController@addToCart')->name('site.cart.addToCart');

        // remove item from the cart
        Route::get('remove/{index}', 'CartController@removeItem')->name('site.cart.removeItem');

    });

});