<?php

use Illuminate\Support\Facades\Route;


Route::get('','ajaxController@index');
Route::post('commenti/{post}', 'ajaxController@commenti')->name('json_commenti');
Route::post('prossimaPagina','ajaxController@prossimaPaginaHandler');
Route::post('prossimoCommento', 'ajaxController@prossimoCommento');
Route::get('getCrea', 'ajaxController@getFormCrea');

Route::post('post/mettiLike','LikePostController@store');
Route::post('post/togliLike','LikePostController@destroy');

Route::post('vote/handle', 'VoteCommentController@handle');

Route::post('follow', 'FollowController@handle');

Route::post('cercaUtente','ajaxController@cercaUtente');
