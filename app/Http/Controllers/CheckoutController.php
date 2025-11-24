<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $amount = 1000; // Valor em centavos (R$ 1.000,00)
        return view('checkout', compact('amount'));
    }
}
