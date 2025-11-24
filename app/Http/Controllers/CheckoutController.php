<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        
        $amount = 1000;
        return view('checkout', compact('amount'));
    }
}
