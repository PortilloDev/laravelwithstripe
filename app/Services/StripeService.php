<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Traits\ExternalServices;

class StripeService
{
    use ExternalServices;

    protected $key;
    protected $secret;
    protected $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
    }
    
    public function resolveAuthorization(&$queryParams, &$formParams, &$headers)
    {
        $headers['Authorization'] = $this->resolveAccessToken();
    }

    public function decodeResponse($response)
    {
        return \json_decode($response);
    }

    public function resolveAccessToken()
    {
        return "Bearer {$this->secret}";
    }

    public function handlePayment(Request $request)
    {
        //
    }

    public function handleApproval()
    {
        //
    }

    public function createIntent(float $price, string $currency = 'eur', string $paymentMethod )
    {
        return $this->makeRequest(
            'POST',
            '/v1/payment_intents',
            ['Authorization' => $this->resolveAccessToken() ],
            [
                'amount'                => round($price * 100),
                'currency'              => strtolower($currency),
                // 'payment_method'        => $paymentMethod,
                'payment_method_types' => ['card'],
            ]
        );
    }
}
