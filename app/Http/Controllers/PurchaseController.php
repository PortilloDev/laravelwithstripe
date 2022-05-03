<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function show($id)
    {
          $book = Book::find($id);

          return view('Purchase', compact('book'));
    }
}
