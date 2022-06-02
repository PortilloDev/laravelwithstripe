<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Services\StripeService;
class SubscriptionController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe =  $stripe;
    }

    public function show() 
    {
        $plans =  Plan::all();

        return view('plans', compact('plans'));
    }


    public function store(Request $request) 
    {
        $rules = [
            'plan'  => ['required', 'exists:plans,slug'],
            'name'  => ['required'],
            'email' => ['required'],
        ];

        $request->validate($rules);

        try{

            $this->stripe->handleSuscription($request);
        }catch(\Exception $exception) {
            throw new \Exception($exception->getMessage(), 1);
            
        }

        return view('confirmation_page');
    }


    public function approval() 
    {

    }

    public function cancelled() 
    {

    }


}
