<?php


use Illuminate\Support\Facades\Route;

Route::get('', 'adminController@index')->name('admin_index');
Route::get('userlist','adminController@listaUtenti')->name('admin_listautenti');

Route::get('reports/{user}/ricevuti','userController@reportsReceived')->name('admin_report_ricevuti');

Route::get('reports/{tipo}/{id}','adminController@checkReport')->name('check_report');
Route::post('reports/{tipo}/{id}','adminController@readReport');

