<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Myckhel\Mono\Traits\Config;
use Myckhel\Mono\Http\Controllers\AccountController;

$middleware  = Config::config('route.middleware');
$prefix       = Config::config('route.prefix');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function() {
    Route::post('account/auth',     [AccountController::class, 'auth']);
    Route::get('accounts/{id}',     [AccountController::class, 'info']);
    Route::get('accounts/{id}/statement',               [AccountController::class, 'statement']);
    Route::get('accounts/{id}/statement/jobs/{jobId}',    [AccountController::class, 'pollPdf']);
});
