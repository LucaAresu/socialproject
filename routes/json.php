<?php

use Illuminate\Support\Facades\Route;


Route::get('','ajaxController@index');
Route::post('commenti/{post}', 'ajaxController@commenti')->name('json_commenti');
Route::post('prossimaPagina','ajaxController@prossimaPagina');
Route::post('prossimoCommento', 'ajaxController@prossimoCommento');
Route::get('getCrea', 'ajaxController@getFormCrea');
