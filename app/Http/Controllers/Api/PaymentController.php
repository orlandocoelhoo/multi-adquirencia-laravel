<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Core\GatewayService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function process(Request $request, GatewayService $gatewayService)
    {

        $result = $gatewayService->process($request->all());

        // Lógica para processar o pagamento
        return response()->json($result);
    }
}
