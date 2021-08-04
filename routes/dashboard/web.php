
<?php



Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function() {

    // Logout
    Route::get('logout', 'DashboardController@logout')->name('logout');

    Route::get('home' , 'DashboardController@index')->name('index');

    // Users Routes
    Route::get('all-users', 'UsersController@index')->name('get-all-users');
    Route::get('add-user', 'UsersController@getAddUser')->name('get-add-user');
    Route::post('add-user', 'UsersController@postAddUser')->name('post-add-user');

    Route::get('update-user/{id}', 'UsersController@getUpdateUser')->name('get-update-user');
    Route::post('update-user/{id}', 'UsersController@postUpdateUser')->name('post-update-user');

    Route::get('delete-admin/{id}' ,'UsersController@deleteAdmin')->name('delete-admin');

    //product routes
    Route::group(['prefix' => 'products/'], function () {
        Route::get('', 'ProductsController@getIndex')->name('products.getIndex');
        Route::get('get-create', 'ProductsController@getCreateNewProduct')->name('products.getCreateNewProduct');
        Route::post('create', 'ProductsController@createNewProduct')->name('products.createNewProduct');
        Route::get('get-update/{id}', 'ProductsController@getUpdateProduct')->name('products.getUpdateProduct');
        Route::post('post-update/{id}', 'ProductsController@updateProduct')->name('products.updateProduct');
        Route::delete('delete/{id}', 'ProductsController@deleteProduct')->name('products.deleteProduct');
    });


});
