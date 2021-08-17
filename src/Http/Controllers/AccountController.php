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

    /**
     * This resource represents the known transactions on the account.
     *
     * @return \Illuminate\Http\Response
     */
    public function transactions(Request $request, $id)
    {
        return Account::transactions($id, $request->all());
    }

    /**
     * This resource will return income information on the account.
     *
     * @return \Illuminate\Http\Response
     */
    public function income(Request $request, $id)
    {
        return Account::income($id, $request->all());
    }

    /**
     * This resource provides a high level overview of an account identity data.
     *
     * @return \Illuminate\Http\Response
     */
    public function identity(Request $request, $id)
    {
        return Account::identity($id, $request->all());
    }

    /**
     *
     * @return \Illuminate\Http\Response
     */
    public function sync(Request $request, $id)
    {
        return Account::sync($id, $request->all());
    }

    /**
     * Reauth code is a mono generated code for the account you want to re-authenticate,
     * which must be requested by your server and sent to your frontend where you can pass it to mono connect widget.
     *
     * Mono connect widget will ask for the required information and re-authenticate the user's account and notify your server.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function reauthorise(Request $request, $id)
    {
        return Account::reauthorise($id, $request->all());
    }

    /**
     * This enables you to provide your customers with the option to unlink their financial account(s)
     *
     * @return \Illuminate\Http\Response
     */
    public function unlink(Request $request, $id)
    {
        return Account::unlink($id, $request->all());
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function coverage(Request $request)
    {
        return Account::coverage($request->all());
    }
}
