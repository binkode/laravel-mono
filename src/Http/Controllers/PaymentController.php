<?php

namespace Myckhel\Mono\Http\Controllers;

use Illuminate\Http\Request;
use Myckhel\Mono\Support\Payment;

class PaymentController extends Controller
{
    function __call($method, $args) {
        return Payment::$method(request()->all());
    }
}
