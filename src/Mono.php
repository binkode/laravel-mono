<?php

namespace Myckhel\Mono;

class Mono
{
    /**
     * Verify webhook secret against webhook secret declared in config
     *
     * @param string $secret
     *
     * @return void
     */
    static function verifyWebHook(string $secret) {
        return $secret == config('mono.webhook_secret');
    }
}
