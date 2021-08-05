<?php

namespace Myckhel\Mono\Http\Controllers;

use Illuminate\Http\Request;
use Myckhel\Mono\Support\Account;

class AccountController extends Controller
{
    /**
     * Use this endpoint to request for account
     * id (that identifies the authenticated account)
     * after successful enrolment on the Mono connect widget.
     *
     * @return \Illuminate\Http\Response
     */
    public function auth(Request $request)
    {
        return Account::auth($request->code);
    }

    /**
     * Use this endpoint to request for account
     * id (that identifies the authenticated account)
     * after successful enrolment on the Mono connect widget.
     *
     * @return \Illuminate\Http\Response
     */
    public function info(Request $request, $id)
    {
        return Account::info($id);
    }

    /**
     * This resource represents the account details with the financial institution.
     *
     * @return \Illuminate\Http\Response
     */
    public function statement(Request $request, $id)
    {
        return Account::statement($id, $request->all());
    }

    /**
     * If you set the output as PDF, you can use this endpoint to poll the status.
     *
     * @return \Illuminate\Http\Response
     */
    public function pollPdf(Request $request, $id, $jobId)
    {
        return Account::pollPdf($id, $jobId, $request->all());
    }
}
