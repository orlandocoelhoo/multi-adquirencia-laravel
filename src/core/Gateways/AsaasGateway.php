<?php

namespace Core\Gateways;

use Core\Interfaces\PaymentGatewayInterface;

class AsaasGateway implements PaymentGatewayInterface

{
    public function processPayment(array $paymentData): array
    {
        return ['gateway' => 'Asaas', 'status' => 'success'];
    }

    public function save()
    {

    }
}
