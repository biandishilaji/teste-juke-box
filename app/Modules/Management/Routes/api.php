<?php
use Illuminate\Support\Facades\Route;

Route::namespace('App\Modules\Management\Controllers')->group(function () {
    Route::post('/books/create', 'PessoaController@postCreatePessoa');
    Route::get('/books', 'PessoaController@getPessoas');
    Route::get('/books/{id}/details', 'PessoaController@getPessoaById');
    Route::delete('/books/{id}', 'PessoaController@deletePessoa');
    Route::put('/books/update', 'PessoaController@updatePessoa');
});
