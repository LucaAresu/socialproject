<?php


use Illuminate\Support\Facades\Route;

Route::get('', 'adminController@index')->name('admin_index');
Route::get('userlist','adminController@listaUtenti')->name('admin_listautenti');

