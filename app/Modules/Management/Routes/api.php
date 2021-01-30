<?php

Route::namespace('App\Modules\Management\Controllers')->group(function () {


    Route::group(['middleware' => ['api']], function () {
     
        Route::group(['middleware' => ['jwt.auth']], function () {
            // autenticado
            Route::post('/services/create', 'ServiceController@postCreateService');
            Route::get('/services/{id}', 'ServiceController@getServiceById');
            Route::delete('/services/{id}', 'ServiceController@deleteService');
            Route::put('/services/update', 'ServiceController@updateService');
            Route::get('/services', 'ServiceController@getServices');
        });
    });
});
