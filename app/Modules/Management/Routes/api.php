<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Modules\Management\Controllers')->group(function () {


    Route::group(['middleware' => ['api']], function () {
     
        Route::group(['middleware' => ['jwt.auth']], function () {
            /***
             * Services
             */
            Route::post('/services/create', 'ServiceController@postCreateService');
            Route::get('/services/{id}/details', 'ServiceController@getServiceById');
            Route::delete('/services/{id}', 'ServiceController@deleteService');
            Route::put('/services/update', 'ServiceController@updateService');
            Route::get('/services', 'ServiceController@getServices');
             /***
             * Clients
             */
            Route::post('/clients/create', 'ClientController@postCreateClient');
            Route::get('/clients/{id}/details', 'ClientController@getClientById');
            Route::delete('/clients/{id}', 'ClientController@deleteClient');
            Route::put('/clients/update', 'ClientController@updateClient');
            Route::get('/clients', 'ClientController@getClients');

        });
    });
});
