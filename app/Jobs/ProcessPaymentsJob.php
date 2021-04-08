<?php

namespace App\Jobs;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPaymentsJob
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment = Payment::where('tx_ref', $this->transaction)->first();
        return $payment;
        // $payment->update(['payment_id' => $this->transaction['id'], 'status' => $this->transaction['status']]);
    }
}
