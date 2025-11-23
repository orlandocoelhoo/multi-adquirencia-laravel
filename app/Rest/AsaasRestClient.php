<?php

namespace App\Rest;

class AsaasRestClient
{
    public function createPayment(array $paymentData): array
    {
        // Aqui seria a logica de intregração com a api do asaas utilizando cURL ou GuzzleHttp
        // Simulação de chamada à API do Asaas
        return [
            'id' => 'asaas_payment_123',
            'status' => 'success',
            'amount' => $paymentData['amount'],
            'dueDate' => $paymentData['due_date'],
        ];
    }
}
