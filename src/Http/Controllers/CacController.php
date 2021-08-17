<?php

namespace Myckhel\Mono\Http\Controllers;

use Myckhel\Mono\Support\Cac;

class CacController extends Controller
{
    function __call($method, $args) {
        if ($args) {
            return Cac::$method($args[0], request()->all());
        } else {
            return Cac::$method(request()->all());
        }
    }
}
