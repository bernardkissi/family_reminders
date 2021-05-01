<?php

namespace App\Http\Controllers\API\Payments;

use App\Domains\Contribution\Contribution;
use App\Domains\Payment\Actions\PaymentActions;
use App\Domains\Payment\Providers\Flutterwave;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function __construct(public PaymentActions $payment)
    {
    }


    /**
     * [contribute description]
     * @param  Flutterwave  $gateway    [description]
     * @param  Contribution $contribute [description]
     * @param  Request      $request    [description]
     * @return [type]                   [description]
     */
    public function contribute(Contribution $contribution, Flutterwave $gateway, Request $request)
    {
        return $this->payment->pay($contribution, $gateway, $request);
    }
}
