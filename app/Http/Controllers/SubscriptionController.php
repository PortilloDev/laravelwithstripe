<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plan;
use App\Services\StripeService;
class SubscriptionController extends Controller
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeService();
    }

    public function show() 
    {
        $plans =  Plan::all();

        return view('plans', compact('plans'));
    }


    public function store(Request $request) 
    {
        $rules = [
            'plan' => ['required', 'exists:plans,slug'],
        ];

        $request->validate($rules);

        $this->stripe->handleSuscription($request);
    }


    public function approval() 
    {

    }

    public function cancelled() 
    {

    }


}
