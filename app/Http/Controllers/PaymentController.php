<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        dd($request->all());
        $rules = [
            'price' => ['required', 'numeric', 'min:5']
        ];
        $request->validate($rules);

        

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
