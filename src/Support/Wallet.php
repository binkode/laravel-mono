<?php

namespace Myckhel\Mono\Support;
use Myckhel\Mono\Traits\Request;

class Wallet {
    use Request;

    /**
     * Wallet balance
     *
     * @return \Illuminate\Http\Response
     */
    static function balance($params = []) {
        return self::get("/users/stats/wallet", $params);
    }
}
