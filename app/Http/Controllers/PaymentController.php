<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPaymentsJob;
use App\Models\Contribution;
use App\Models\Payment;
use App\Services\Payments\Gateways\Flutterwave;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Make Contribution
     *
     * @param  Request     $request [description]
     * @param  Flutterwave $gateway [description]
     * @return [type]               [description]
     */
    public function contribute(Request $request, Flutterwave $gateway)
    {
        
        if ($request->amount < $request->min_value) {
            return response()
            ->json(['message' => 'Please the amount you contribute is too low. At least above GHS'. $request->min_value], 400);
        }
        $code = mt_rand(100000, 999999);
        $contribute = Contribution::where('slug', $request->contribution)->first();
        $contribute->payments()->create(['amount' => $request->amount, 'tx_ref' => $code]);

        return $gateway->charge($request->name, $request->amount, $code);
    }


    /**
     * Process contribution
     *
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function processPayment(Request $request)
    {
        ProcessPaymentsJob::dispatch($request->transaction['tx_ref']);
        //return $request->transaction['tx_ref'];
    }

    /**
     * Return all payments made
     *
     * @return [type] [description]
     */
    public function index()
    {
        return Payment::with('contribution')->orderBy('created_at', 'desc')->paginate(20);
    }
}
