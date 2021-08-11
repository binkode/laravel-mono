<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Myckhel\Mono\Traits\Config;
use Myckhel\Mono\Http\Controllers\AccountController;
use Myckhel\Mono\Http\Controllers\Controller;

$middleware  = Config::config('route.middleware');
$prefix       = Config::config('route.prefix');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function() {
    Route::post('account/auth',     [AccountController::class, 'auth']);
    Route::get('accounts/{id}',     [AccountController::class, 'info']);
    Route::get('accounts/{id}/statement',               [AccountController::class, 'statement']);
    Route::get('accounts/{id}/statement/jobs/{jobId}',  [AccountController::class, 'pollPdf']);
    Route::get('accounts/{id}/transactions',            [AccountController::class, 'transactions']);
    Route::get('accounts/{id}/income',                  [AccountController::class, 'income']);
    Route::get('accounts/{id}/identity',                [AccountController::class, 'identity']);
    Route::post('accounts/{id}/sync',                   [AccountController::class, 'sync']);
    Route::post('accounts/{id}/reauthorise',            [AccountController::class, 'reauthorise']);
    Route::post('accounts/{id}/unlink',                 [AccountController::class, 'unlink']);
});
