<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProcessPaymentRequest;
use Core\GatewayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(ProcessPaymentRequest $request, GatewayService $gatewayService)
    {
        $result = $gatewayService->process($request->all());

        return response()->json($result);
    }
}
