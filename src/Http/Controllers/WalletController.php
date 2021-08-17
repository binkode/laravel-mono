<?php

namespace Myckhel\Mono\Http\Controllers;

use Myckhel\Mono\Support\Wallet;

class WalletController extends Controller
{
    function __call($method, $args) {
        return Wallet::$method(request()->all());
    }
}
