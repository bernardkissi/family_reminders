<?php

declare(strict_types=1);

namespace App\Domains\Payment\Actions;

use App\Domains\Contribution\Contribution;
use App\Domains\Payment\Jobs\ProcessPaymentsJob;
use App\Domains\Payment\Payment;
use App\Domains\Payment\Providers\Flutterwave;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PaymentActions
{
    /**
     *  Process user contribution
     *
     * @param  Flutterwave $gateway App\Domains\Payment\Providers\Flutterwave
     * @param  array  $data
     * @return array
     */
    public function pay(Contribution $contribution, Flutterwave $gateway, Request $request): string
    {

        if ($request->amount < $contribution->min_value) {
            return response()
            ->json(['message' => 'Please the amount you contribute is too low. At least above GHS'. $request->min_value], 400);
        }

        $code = mt_rand(100000, 999999);
        $contribution->payments()->create([

            'amount' => $request->amount,
            'tx_ref' => $code,
            'name' =>   $request->user['name'],
            'email' =>  $request->user['email'],
            'mobile' => $request->user['mobile']
        ]);

        return $gateway->charge($request->user, $request->amount, $code);
    }


    /**
     * Process payment transcation
     *
     * @param  array  $transaction
     * @return void
     */
    public function processTranscation(array $transaction): void
    {
        ProcessPaymentsJob::dispatch($transaction);
    }


    /**
     * Returns all payments
     *
     * @return Collection Illuminate\Support\Collection
     */
    public function all(): Collection
    {
        return Payment::with(array('contribution' => function ($query) {
            $query->select(['id', 'title']);
        }))
        ->orderBy('created_at', 'desc')
        ->groupBy('contribution_id')
        ->paginate(10);
    }


    /**
     * Returns a single payment
     *
     * @param  Payment $payment use App\Domains\Payment\Payment;
     * @return Payment
     */
    public function payment(Payment $payment): Payment
    {
        return $payment->select(['id', 'amount', 'payment_type', 'payment_id', 'status'])
               ->get();
    }
}
