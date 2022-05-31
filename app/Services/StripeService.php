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
    protected $stripe;
    protected $plans;

    public function __construct()
    {
        $this->baseUri = config('services.stripe.base_uri');
        $this->key = config('services.stripe.key');
        $this->secret = config('services.stripe.secret');
        $this->stripe = new \Stripe\StripeClient(
            config('services.stripe.secret')
          );
        $this->plans = config('services.stripe.plans');
    }
    

    public function handleSuscription(Request $request)
    {

        try{

            $customer = $this->createCustomer($request->name, $request->email, $request->payment_method);
            $price_select_plan= $this->plans[$request->plan];
            $subscription = $this->createSubscription($customer->id,  $request->payment_method,  $price_select_plan);

        }catch(\Exception $exception) {
            throw new \Exception($exception->getMessage(), 1);
            
        }

        return  $subscription;
    }


    public function handleApproval()
    {
        //
    }

    /**
     * Create a payment intention
     */
    public function createIntent(float $price, string $currency = 'eur', string $paymentMethod )
    {

         return  $this->stripe->paymentIntents->create([
            'amount' => $price*100,
            'currency' => $currency,
            'payment_method_types' => ['card'],
            'payment_method'        => $paymentMethod,
          ]);
      
    }

    /**
     * Confirm an intention to pay
     */
    public function confirmPayment($paymentIntentId, $paymentMethod)
    {
        $this->stripe->paymentIntents->confirm(
            $paymentIntentId,
            ['payment_method' => $paymentMethod]
          );
    }

    
    /**
     * Create a new customer
     */
    public function createCustomer(string $name, string $email, string $paymentMethod)
    {

        return    $this->stripe->customers->create([
                'name' => $name,
                'email' => $email,
                'payment_method' => $paymentMethod
            ]);
        }


     /**
     * Create a new subscription
     */
    public function createSubscription( $customerId, $paymentMethod, $priceId)
    {
        return $this->stripe->subscriptions->create([
            'customer' =>  $customerId,
            'items' => [
              ['price' => $priceId],
            ],
            'default_payment_method' =>  $paymentMethod
          ]);
    }
    
}
