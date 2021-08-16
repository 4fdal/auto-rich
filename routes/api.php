<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\PromotionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::post('forget_password', [AuthController::class, 'forgetPassword']);
        Route::post('reset_password', [AuthController::class, 'resetPassword']);
        Route::post('register_verification', [AuthController::class, 'registerVerification']);
        Route::post('resend_verification_code', [AuthController::class, 'resendVerificationCode']);

        Route::group(['middleware' => ['auth:api-jwt']], function () {
            Route::post('me', [AuthController::class, 'me']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
        });
    });

    Route::group(['middleware' => 'auth:api-jwt'], function(){
        Route::group(['prefix' => 'profile'], function () {
            Route::get('/', [ProfileController::class, 'read']);
        });

        Route::group(['prefix' => 'promotion'], function(){
            Route::post('/sms-broadcast', [PromotionController::class, 'smsBroadcast']);
        });
    });

    Route::group(['prefix' => 'product'], function () {
        Route::group(['middleware' => 'auth:api-jwt'], function () {
            Route::get('/browse-user', [ProductController::class, 'browseUser']);
            Route::post('/add', [ProductController::class, 'add']);
            Route::post('/edit', [ProductController::class, 'edit']);
            Route::delete('/delete', [ProductController::class, 'delete']);
        });

        Route::get('/', [ProductController::class, 'browse']);
        Route::get('/{id}', [ProductController::class, 'read']);
    });



});
