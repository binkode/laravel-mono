<?php

namespace Myckhel\Mono\Support;
use Myckhel\Mono\Traits\Request;

class Payment {
    use Request;

    /**
     * Initiate debit
     *
     * @return \Illuminate\Http\Response
     */
    static function initiate($params = []) {
        return self::post("/payments/initiate", $params, true);
    }

    /**
     * Verify transaction
     *
     * @return \Illuminate\Http\Response
     */
    static function verify($params = []) {
        return self::post("/payments/verify", $params, true);
    }

    /**
     * One time debit status
     *
     * @return \Illuminate\Http\Response
     */
    static function oneTimePayment($params = []) {
        return self::get("/payments/one-time-payment", $params, true);
    }

    /**
     * Create a Plan
     *
     * @return \Illuminate\Http\Response
     */
    static function createPlan($params = []) {
        return self::post("/payments/plans", $params, true);
    }

    /**
     * List plans
     *
     * @return \Illuminate\Http\Response
     */
    static function listPlans($params = []) {
        return self::get("/payments/plans", $params, true);
    }

    /**
     * Update a plan
     *
     * @return \Illuminate\Http\Response
     */
    static function updatePlan($params = []) {
        return self::put("/payments/plans", $params, true);
    }

    /**
     * Delete a plan
     *
     * @return \Illuminate\Http\Response
     */
    static function deletePlan($params = []) {
        return self::delete("/payments/plans", $params, true);
    }
}
