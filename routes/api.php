<?php

use Illuminate\Http\Request;

Route::post('login', 'API\AuthController@login')->middleware('cors');
Route::post('register', 'API\AuthController@register')->middleware('cors');
Route::get('products/{type}', 'API\ProductController@getProductByType')->middleware('cors');

Route::middleware('jwt.auth')->group(function(){
    Route::get('user', 'API\UserController@getUser');
    Route::delete('logout', 'API\AuthController@logout');
});
