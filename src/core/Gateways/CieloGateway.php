<?php

namespace Core\Gateways;

use App\Rest\CieloRestClient;
use Core\Interfaces\PaymentGatewayInterface;
use Core\UseCase\SavePayment;
use Exception;

class CieloGateway implements PaymentGatewayInterface

{
    public function processPayment(array $paymentData): array
    {
        try {
            // Simulação de processamento de pagamento com Cielo
             $cieloResponse = new CieloRestClient();
             $response = $cieloResponse->createPayment($paymentData);

             $save = $this->save([
                 'name' => $paymentData['name'],
                 'amount' => $paymentData['amount'],
                 'installment' => $paymentData['installment'],
                 'dueDate' => $paymentData['due_date'],
                 'status' => $response['status'],
                 'rawResponse' => $response,
             ]);

             return ['gateway' => 'Cielo', 'status' => $save];

        } catch (Exception $e) {
            throw new Exception("Error processing payment: " . $e->getMessage(), 1);
        }
    }

    public function save(array $data): bool
    {
        SavePayment::execute(
            'Cielo',
            $data['name'],
            $data['amount'],
            $data['installment'],
            $data['dueDate'],
            $data['status'],
            json_encode($data['rawResponse'])
        );

        return true;
    }

}
