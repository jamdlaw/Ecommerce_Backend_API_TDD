<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Product;
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/* product routes */
Route::post('product', 'ProductController@store');
Route::patch('product/{product}', 'ProductController@update');

/*customer routes */
Route::get('customer/{customer_id}', 'CustomerController@show' );


/* order routes */
Route::get('orders/', 'OrderController@pendingOrders' );
