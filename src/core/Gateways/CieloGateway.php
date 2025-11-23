<?php

namespace Core\Gateways;

use Core\Interfaces\PaymentGatewayInterface;

class CieloGateway implements PaymentGatewayInterface

{
    public function processPayment(array $paymentData): array
    {
        return ['gateway' => 'Cielo', 'status' => 'success'];
    }
}
