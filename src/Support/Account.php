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

    static function transactions(string $id, $params = []) {
        return self::get("/accounts/$id/transactions", $params);
    }

    static function income(string $id, $params = []) {
        return self::get("/accounts/$id/income", $params);
    }

    static function identity(string $id, $params = []) {
        return self::get("/accounts/$id/identity", $params);
    }

    static function sync(string $id, $params = []) {
        return self::post("/accounts/$id/sync", $params);
    }

    static function reauthorise(string $id, $params = []) {
        return self::post("/accounts/$id/reauthorise", $params);
    }

    static function unlink(string $id, $params = []) {
        return self::post("/accounts/$id/unlink", $params);
    }

    static function coverage($params = []) {
        return self::get("/coverage", $params);
    }
}
