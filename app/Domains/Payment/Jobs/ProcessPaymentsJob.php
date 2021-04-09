<?php

namespace App\Domains\Payment\Jobs;

use App\Domains\Payment\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessPaymentsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transcation;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $transaction)
    {
        $this->transcation = $transcation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $payment = Payment::where('tx_ref', $this->transcation)->first();
        $payment->update([
            'payment_id' => $this->transcation->payment_id,
            'status' => $this->transcation->status,
            'payment_type' => $this->transcation->payment_type,
            'amount' => $this->transcation->amount
        ]);
    }
}
