<?php


namespace App\Services\Payments\Gateways;

use Illuminate\Support\Facades\Http;

class Flutterwave
{


    public function charge($name, $amount, $code)
    {

        $payload = $this->payload($name, $amount, $code);
        $response = Http::withToken(env('FLUTTERWAVE_SEC_KEY'))->post(config('flutterwave.url'), $payload);
        return $response;
        if ($response->failed()) {
            return response()->json(['message' => 'Your payment has failed']);
        }

        return $response;
    }

    protected function payload($user, $amount, $code)
    {

        return [

            'tx_ref' => $code,
            'amount' => $amount,
            'currency' => 'GHS',
            'payment_options' => 'mobilemoney,ussd,card',
            'redirect_url' => route('home'),
            'customer' => [ 'name' => $user , 'email' => 'bernardkissi18@gmail.com'],
            'subaccounts'=> [
                
                [
                    'id' => 'RS_2F2994AA79A4EA872478C535F268A884',
                    'transaction_charge_type' => "percentage",
                    'transaction_charge' =>  0.00
                ]
            ],
            
            'customization' => [ 'title' => 'Kissi Family' ]
        ];
    }
}
