<?php

Route::group(['prefix' => '/api/v1/'], function () {
    Route::get('/board', 'MainController@board');
});
