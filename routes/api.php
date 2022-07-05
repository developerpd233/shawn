<?php

// signup and login
Route::post('v1/signup', 'Api\V1\Admin\AuthApiController@signup');
Route::post('v1/login', 'Api\V1\Admin\AuthApiController@login');
Route::post('v1/social-login', 'Api\V1\Admin\AuthApiController@socialLogin');
Route::post('v1/forgot-password', 'Api\V1\Admin\AuthApiController@forgotPassword');
Route::post('v1/reset-password', 'Api\V1\Admin\AuthApiController@reset');

// Admin
Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::get('users/show-profile', 'UsersApiController@showProfile')->name('users.showProfile');
    Route::patch('users/update-profile', 'UsersApiController@updateProfile')->name('users.updateProfile');
    Route::post('users/update-profile-image', 'UsersApiController@updateProfileImage')->name('users.updateProfileImage');
    Route::apiResource('users', 'UsersApiController');

    // Product Category
    Route::post('product-categories/media', 'ProductCategoryApiController@storeMedia')->name('product-categories.storeMedia');
    Route::apiResource('product-categories', 'ProductCategoryApiController');

    // Product Tag
    Route::apiResource('product-tags', 'ProductTagApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Manufacturer
    Route::apiResource('manufacturers', 'ManufacturerApiController');

    // Content Category
    Route::apiResource('content-categories', 'ContentCategoryApiController');

    // Content Tag
    Route::apiResource('content-tags', 'ContentTagApiController');

    // Content Page
    Route::post('content-pages/media', 'ContentPageApiController@storeMedia')->name('content-pages.storeMedia');
    Route::apiResource('content-pages', 'ContentPageApiController');

    // Review
    Route::apiResource('reviews', 'ReviewApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');

    // Transaction
    Route::apiResource('transactions', 'TransactionApiController');

    // Blog
    Route::post('blogs/media', 'BlogApiController@storeMedia')->name('blogs.storeMedia');
    Route::apiResource('blogs', 'BlogApiController');

    // Type
    Route::apiResource('types', 'TypeApiController');

    // Chat
    Route::apiResource('chats', 'ChatApiController');

    // Setting
    Route::apiResource('settings', 'SettingApiController');

    // logout 
    Route::post('logout', 'AuthApiController@logout');
});
