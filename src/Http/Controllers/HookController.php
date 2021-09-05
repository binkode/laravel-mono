<?php

namespace Myckhel\Mono\Http\Controllers;

use Myckhel\Mono\Events\Hook;
use Mono;
use Illuminate\Http\Request;

class HookController extends Controller
{
    public function hook(Request $request) {
        if (!Mono::verifyWebHook($request->header('mono-webhook-secret')))
            return abort(403);

        event(new Hook($request->all()));
        return ['status' => true];
    }
}
