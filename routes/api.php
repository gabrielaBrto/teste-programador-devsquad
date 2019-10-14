<?php

use Illuminate\Http\Request;

Route::post('logar', 'UserController@login');
Route::post('verifica', 'UserController@verifica');

Route::get('/produtos/categorias','ProdutoController@categorias');
Route::post('/produtos/create', 'ProdutoController@store');
Route::get('/produtos/edit/{id}', 'ProdutoController@edit');
Route::post('/produtos/update/{id}', 'ProdutoController@update');
Route::delete('/produtos/delete/{id}', 'ProdutoController@delete');
Route::get('/produtos/pesquisa/{dado}', 'ProdutoController@pesquisa');
Route::get('/produtos/visualizar/{id}','ProdutoController@show');
Route::get('/produtos', 'ProdutoController@index');
