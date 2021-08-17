<?php

namespace Myckhel\Mono\Support;
use Myckhel\Mono\Traits\Request;

class Cac {
    use Request;

    /**
     * Look up a business
     *
     * @return \Illuminate\Http\Response
     */
    static function lookup($params = []) {
        return self::get("/cac/lookup", $params, true);
    }

    /**
     * Look up a business
     *
     * @return \Illuminate\Http\Response
     */
    static function company($id, $params = []) {
        return self::get("/cac/company/$id", $params, true);
    }
}
