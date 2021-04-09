<?php

declare(strict_types=1);

namespace App\Domains\Payment\Providers;

use Illuminate\Support\Facades\Http;

class Flutterwave
{
    /**
     *  Process payments to the flutterwave server
     *
     * @param  array  $user
     * @param  string $amount
     * @param  int    $code
     * @return array
     */
    public function charge(array $user, string $amount, int $code): array
    {
        
        $payload = $this->payload($user, $amount, $code);
        
        $response = Http::withToken(env('FLUTTERWAVE_SEC_KEY'))
            ->post(config('flutterwave.url'), $payload);
        
        if ($response->failed()) {
            return response()->json(['message' => 'Your payment has failed']);
        }

        return $response;
    }


    /**
     *  Returns payment data object
     *
     * @param  array  $user
     * @param  string $amount
     * @param  int    $code
     * @return array
     */
    protected function payload(array $user, string $amount, int $code): array
    {
        return [

            'tx_ref' => $code,
            'amount' => $amount,
            'currency' => 'GHS',
            'payment_options' => 'mobilemoney,ussd,card',
            'redirect_url' => route('home'),
            'customer' => [
                'name' => $user->name ,
                'email' => $user->email ,
                'mobile' => $user->mobile
            ],
            'subaccounts'=> [
                
                [
                    'id' => 'RS_2F2994AA79A4EA872478C535F268A884',
                    'transaction_charge_type' => "percentage",
                    'transaction_charge' =>  0.00
                ]
            ],
            
            'customization' => [ 'Title' => 'Kissi Family' ]
        ];
    }
}
