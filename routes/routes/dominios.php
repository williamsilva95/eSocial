<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'dominio'], function () {

    Route::get('/', 'DominioController@index');

    Route::get('/create', 'DominioController@create');

    Route::post('/store', 'DominioController@store');

    Route::get('/edit/{dominio}', 'DominioController@edit');

    Route::post('/destroy', 'DominioController@destroy');

    Route::get('/show/{dominio}','DominioController@show');

    Route::get('pesquisar','DominioController@pesquisar');

    Route::post('pesquisar','DominioController@pesquisar');

    Route::get('exportar','DominioController@exportar');

});
