<?php

use Illuminate\Http\Request;

Route::get('/test', function (Request $request) {
    return 'mart-server.com';
});

Route::apiResource('categories', 'CategoryController');
