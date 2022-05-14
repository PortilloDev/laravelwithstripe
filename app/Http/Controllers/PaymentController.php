<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        $rules = [
            'price' => ['required', 'numeric', 'min:5']
        ];
        $request->validate($rules);

        $stripe = new StripeService();

        $reponse = $stripe->createIntent($request->get('price'), 'eur', $request->get('payment_method') );
        dd($reponse);
        return $request->all();
    }

    public function approval()
    {
        //
    }

    public function cancelled()
    {
        return redirect()
        ->route('bookstore')
        ->withErrors('Se ha cancelado el pago');
    }
}
