<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StripeService;
use App\Models\Book;

use Stripe;
use Session;

class PaymentController extends Controller
{
    protected $stripe;

    public function __construct(StripeService $stripe)
    {
        $this->stripe = $stripe;
    }
    public function show($id)
    {
          $book = Book::find($id);

          return view('Purchase', compact('book'));
    }

    /**
     * Creates an intention to pay and its confirmation
     * 
     */
    public function pay(Request $request)
    {
        $rules = [
            'price' => ['required', 'numeric', 'min:5']
        ];
       
        $request->validate($rules);
       

        
        try{
            $payment_intent = $this->stripe->createIntent($request->price, 'eur', $request->payment_method );

            $this->approval($payment_intent->id, $request->payment_method);

       }catch(\Excepction $exception) {
            
            return redirect()->back()->withErrors('No se ha podido completar el pago de su pedido')->withInput();
       }
       $book = json_decode($request->book, true);
       
       return view('confirmation_page', compact('book'));
    }

    /**
     * create payment confirmation
     * 
     */
    public function approval($payment_intent_id, $payment_method)
    {
        try{
            $this->stripe->confirmPayment($payment_intent_id, $payment_method);

        }catch(\Excepction $exception){

            return false;
        }
    }

    /**
     * Cancel a payment
     */
    public function cancelled()
    {
        return redirect()
        ->route('bookstore')
        ->withErrors('Se ha cancelado el pago');
    }
}
