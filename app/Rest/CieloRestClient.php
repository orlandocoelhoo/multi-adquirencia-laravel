<?php

namespace App\Rest;

class CieloRestClient
{
    public function createPayment(array $paymentData): array
    {

        // Simulação de erro temporário
        throw new \Exception("Falha temporária no gateway Cielo.");
        
        // Aqui seria a logica de intregração com a api da Cielo utilizando cURL ou GuzzleHttp
        // Simulação de retorno da API Cielo
        return [
            'id' => 'cielo_payment_123',
            'status' => 'success',
            'amount' => $paymentData['amount'],
            'dueDate' => $paymentData['due_date'],
        ];
    }
}
