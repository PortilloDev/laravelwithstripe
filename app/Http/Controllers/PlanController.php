<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
   public function getPlan()
   {
     $plans =  Plan::all();

     return view('plans', compact('plans'));
   }
}
