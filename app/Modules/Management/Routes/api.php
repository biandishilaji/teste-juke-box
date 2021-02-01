<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Modules\Management\Controllers')->group(function () {
    Route::post('/pessoas/create', 'PessoaController@postCreatePessoa');
    Route::get('/pessoas', 'PessoaController@getPessoas');
    Route::get('/pessoas/{id}/details', 'PessoaController@getPessoaById');
    Route::delete('/pessoas/{id}', 'PessoaController@deletePessoa');
    Route::put('/pessoas/update', 'PessoaController@updatePessoa');
});
