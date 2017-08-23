<?php

// ここはログインの必要無し
Route::get('/login', 'Auth\RegisterController@register')->name('login');

// ログインの必要あり
Route::group(['middleware' => ['auto_user']], function () {
    Route::get('/', 'MainController@home');
    Route::get('single/{code?}', 'SinglePlayController@single');
});

