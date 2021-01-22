<?php

Route::namespace('App\Modules\Account\Controllers')->group(function () {


    Route::group(['middleware' => ['api']], function () {

        Route::post('/login', 'AuthController@login');
        Route::post('/register', 'AuthController@register');
        Route::post('/logout', 'AuthController@logout');
        Route::post('/refresh', 'AuthController@refresh');

        Route::group(['middleware' => ['jwt.auth']], function () {

            Route::get('/user-profile', 'AuthController@userProfile');

        });
    });
});
