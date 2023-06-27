<?php

    /*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
    */

//    Route::get('products', 'Front\FrontendController@indexApi');
    use App\Http\Controllers\Front\FrontendController;

    Route::get('products', [FrontendController::class, 'indexApi']);
