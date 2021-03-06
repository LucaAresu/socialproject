<?php


use Illuminate\Support\Facades\Route;

Route::get('','adminController@listaUtenti')->name('admin_index');

Route::get('reports/{user}/ricevuti','userController@reportsReceived')->name('admin_report_ricevuti');
Route::get('reports/{user}/fatti', 'userController@reportsDone')->name('admin_report_fatti');

Route::get('reports/{tipo}/{id}','adminController@checkReport')->name('check_report');
Route::post('reports/{tipo}/{id}','adminController@readReport');

Route::post('ban/','adminController@banOrRestore')->name('admin_ban');

