<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->group(function () {
    /* product routes */
    Route::post('product', 'ProductController@store');
    Route::patch('product/{product}', 'ProductController@update');
    /*customer routes */
    Route::get('customer/{customer_id}', 'CustomerController@show' );
    /* order routes */
    Route::get('orders/', 'OrderController@pendingOrders' );
    Route::patch('order/{order}', 'OrderController@updateOrderStatus');
    Route::post('order/shipments/{order}', 'ShipmentController@store');
    
});


