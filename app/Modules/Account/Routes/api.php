<?php

Route::namespace('App\Modules\Account\Controllers')->group(function () {

    Route::post('/login', 'AuthController@login');

});
