<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function(){
    Route::apiResources([
        '/contacts' => 'ContactController',
    ]);
});


//Route::post('/contacts', 'ContactController@store');
//Route::get('/contacts/{contact}', 'ContactController@show');
//Route::patch('/contacts/{contact}', 'ContactController@update');
//Route::delete('/contacts/{contact}', 'ContactController@destroy');
