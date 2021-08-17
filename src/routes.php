<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Myckhel\Mono\Traits\Config;
use Myckhel\Mono\Http\Controllers\AccountController;
use Myckhel\Mono\Http\Controllers\PaymentController;

$middleware  = Config::config('route.middleware');
$prefix      = Config::config('route.prefix');

Route::group(['prefix' => $prefix, 'middleware' => $middleware], function() {
    $routes = [
        'account/auth'              => 'post,account,auth',
        'accounts/{id}'             => 'get,account,info',
        'accounts/{id}/statement'   => 'get,account,statement',
        'accounts/{id}/statement/jobs/{jobId}'   => 'get,account,pollPdf',
        'accounts/{id}/transactions'    => 'get,account,transactions',
        'accounts/{id}/income'          => 'get,account,income',
        'accounts/{id}/identity'        => 'get,account,identity',
        'accounts/{id}/sync'            => 'post,account,sync',
        'accounts/{id}/reauthorise'     => 'post,account,reauthorise',
        'accounts/{id}/unlink'          => 'post,account,unlink',
        'payments/initiate'             => 'post,payment,initiate',
        'payments/verify'               => 'post,payment,verify',
        'payments/one-time-payment'     => 'get,payment,oneTimePayment',
        'payments/plans'                => 'post,payment,createPlan',
        'payments/plans/{{planId}}'     => 'put,payment,updatePlan',
    ];

    $controls = [
        'account' => AccountController::class,
        'payment' => PaymentController::class,
    ];

    collect($routes)->map(function ($route, $endpoint) use($controls){
        [$method, $control, $func] = explode(',', $route);
        Route::$method($endpoint, [$controls[$control], $func]);
    });
    Route::get('payments/plans',                [$controls['payment'], 'listPlans']);
    Route::delete('payments/plans/{{planId}}',  [$controls['payment'], 'deletePlan']);
});
