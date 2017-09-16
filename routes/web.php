<?php

// ここはログインの必要無し
Route::get('/login', 'Auth\RegisterController@register')->name('login');

// ログインの必要あり
Route::group(['middleware' => ['auto_user']], function () {
    Route::get('/', function () {
        return redirect('/single');
    });
    Route::get('single/stamps', 'UserController@stamps');
    Route::get('single/{code?}', 'SinglePlayController@single');
    Route::get('stamp/{stampCode?}/image', 'StampController@showImage');
});

Route::get('howto', function() {
    return view('howto');
});