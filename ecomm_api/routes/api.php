<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Product;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('product', 'ProductController@store');

Route::get('customer/{customer_id}', 'CustomerController@show' );

Route::patch('product/{product}', 'ProductController@update');