<?php

namespace Myckhel\Mono\Support;
use Myckhel\Mono\Traits\Request;

class Account {
    use Request;

    static function auth(string $code, $params = []) {
        return self::post('/account/auth', ['code' => $code] + $params);
    }

    static function info(string $id, $params = []) {
        return self::get("/accounts/$id", $params);
    }

    static function statement(string $id, $params = []) {
        return self::get("/accounts/$id/statement", $params);
    }

    static function pollpdf(string $id, $jobId, $params = []) {
        return self::get("/accounts/$id/statement/jobs/$jobId", $params);
    }
}
